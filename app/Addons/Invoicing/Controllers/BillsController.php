<?php

namespace App\Addons\Invoicing\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Invoicing\Models\partner_credit;
use App\Addons\Invoicing\Models\Bill;
use App\Addons\Invoicing\Models\BillProduct;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Auth;
use PDF;
use Purchase;
use Partner;
use Invoicing;
use Addons;

class BillsController extends Controller
{
    public function calculate_code()
    {
        $year=date("Y");
        $month=date("m");
        $prefixcode = "BILL/$year/$month/";
        $count = Bill::where('purchase_no','like',"%".$prefixcode."%")->count();
        if ($count==0){
            return "$prefixcode"."000001";
        }else {
            return $prefixcode.str_pad($count + 1, 6, "0", STR_PAD_LEFT);
        }
    }

    public function index()
    {
        $purchases = Bill::join('res_partners', 'purchases.client', '=', 'res_partners.id')
                    ->select('purchases.*', 'res_partners.partner_name')
                    ->orderBy('created_at', 'desc')
                    ->paginate(30);
        return view('bills.index', compact('purchases'));
    }

    public function search(Request $request)
    {
        $key=$request->filter;
        $value=$request->value;
        if ($key!=""){
            $purchases = Bill::join('res_partners', 'purchases.client', '=', 'res_partners.id')
                    ->select('purchases.*', 'res_partners.partner_name')
                    ->orderBy('created_at', 'desc')
                    ->where($key,'like',"%".$value."%")
                    ->paginate(30);
            $purchases ->appends(['filter' => $key ,'value' => $value,'submit' => 'Submit' ])->links();
        }else{
            $purchases = Bill::join('res_partners', 'purchases.client', '=', 'res_partners.id')
                    ->select('purchases.*', 'res_partners.partner_name')
                    ->orderBy('created_at', 'desc')
                    ->paginate(30);
        }
        return view('bills.index', compact('purchases'));
    }

    public function create()
    {
        $partner = Partner::vendor();
        $product = Inventory::can_be_purchase();
        return view('bills.create', compact('product','partner'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'client' => 'required|max:255',
            'purchase_date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d',
            'discount' => 'required|numeric|min:0',
            'products.*.name' => 'required|max:255',
            'products.*.price' => 'required|numeric|min:1',
            'products.*.qty' => 'required|integer|min:1'
        ]);
 
        $Purchase_no = $this->calculate_code(); 

        $products = collect($request->products)->transform(function($product) {
            $product['total'] = $product['qty'] * $product['price'];
            return new BillProduct($product);
        });

        if($products->isEmpty()) {
            return response()
            ->json([
                'products_empty' => ['One or more Product is required.']
            ], 422);
        }

        $data = $request->except('products'); 
        $data['purchase_no'] = $Purchase_no;
        $data['merchandise'] = Auth::id();
        $data['sub_total'] = $products->sum('total');
        $data['grand_total'] = $data['sub_total'] - $data['discount'];

        $purchases = Bill::create($data);

        $purchases->products()->saveMany($products);

        return response()
            ->json([
                'created' => 'success',
                'id' => $purchases->id
            ]);
    }

    public function show($id)
    {
        $purchases = Invoicing::getBill($id);
        $partner = Partner::vendor();
        return view('bills.show', compact('purchases','partner'));
    }

    public function edit($id)
    {
        $purchase = Invoicing::getBill($id);
        $purchases = Invoicing::getBillLine($id);
        return view('bills.edit', compact('purchase','purchases'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'purchase_no' => 'required|unique:purchases,purchase_no,'.$id.',id',
            'client' => 'required|max:255',
            'purchase_date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d',
            'discount' => 'required|numeric|min:0',
            'products.*.name' => 'required|max:255',
            'products.*.price' => 'required|numeric|min:1',
            'products.*.qty' => 'required|integer|min:1'
        ]);

        $purchase = Invoicing::getBill($id);
        $old_total = $purchase->grand_total;

        $products = collect($request->products)->transform(function($product) {
            $product['total'] = $product['qty'] * $product['price'];
            return new BillProduct($product);
        });

        if($products->isEmpty()) {
            return response()
            ->json([
                'products_empty' => ['One or more Product is required.']
            ], 422);
        }

        $data = $request->except('products');
        $data['sub_total'] = $products->sum('total');
        $data['grand_total'] = $data['sub_total'] - $data['discount'];

        $purchase->update($data);

        BillProduct::where('purchase_id', $purchase->id)->delete();

        $purchase->products()->saveMany($products);

        partner_credit::where('purchase_no',$request->purchase_no)->update([
            'total'=>$data['grand_total'],
        ]);

        $partner = Partner::getVendor($request->client);
        $oldbalance = $partner->debit;
        $total = $oldbalance - $old_total;
        $new_balance = $data['grand_total'] + $total; 
        $partner->update([
            'debit' => $new_balance,
        ]);

        return response()
            ->json([
                'updated' => "success",
                'id' => $purchase->id
            ]);
    }

    public function destroy($id)
    {
        $purchase = Invoicing::getBill($id);

        BillProduct::where('purchase_id', $purchase->id)
            ->delete();

        $purchase->delete();

        return redirect()
            ->route('purchases.index');
    }

    public function approved($id)
    {
        try{
            $purchase = Invoicing::getBill($id);
            partner_credit::insert([
                'purchase_no'=>$purchase->purchase_no,
                'journal'=>'2',
                'partner_id'=>$purchase->client,
                'purchase_date'=>$purchase->purchase_date,
                'due_date'=>$purchase->due_date,
                'total'=>$purchase->grand_total,
            ]);
            $partner = Partner::getVendor($purchase->client);
            $balance = $partner->debit;
            $new_balance = $balance + $purchase->grand_total;
            
            $partner->update([
                'debit' => $new_balance,
            ]);
            $purchase->update([
                'approved'=> True,
                'status'=>"Complete",
            ]);
            return redirect(route('accountmove.purchase',$id));
        }catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    public function Report()
    {
        $month = date('m');
        $year = date('Y');
        $income=Bill::whereMonth('purchase_date', '=', $month)->whereYear('purchase_date', '=', $year)->sum('grand_total');
        $unpaid=Bill::where('paid','0')->whereMonth('purchase_date', '=', $month)->whereYear('purchase_date', '=', $year)->count();
        $notvalidate=Bill::where('approved','0')->whereMonth('purchase_date', '=', $month)->whereYear('purchase_date', '=', $year)->count();
        $purchases = Bill::join('res_partners', 'purchases.client', '=', 'res_partners.id')
                            ->join('hr_employees', 'purchases.merchandise', '=', 'hr_employees.user_id')
                            ->join('partner_credit', 'purchases.purchase_no', '=', 'partner_credit.purchase_no')
                            ->select('purchases.*', 'partner_credit.payment','partner_credit.status','res_partners.partner_name','hr_employees.employee_name')
                            ->whereMonth('purchases.purchase_date', '=', $month)->whereYear('purchases.purchase_date', '=', $year)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        return view('bills.report', compact('income','unpaid','notvalidate','purchases'));
    }

    public function print_pdf($id)
    {
        $purchase = Invoicing::getBill($id);
    	$pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadview('reports.purchases.purchase_pdf', compact('purchase'));
    	return $pdf->stream();
    }

    public function report_print(){
        $month = date('m');
        $year = date('Y');
        $monthName = date("F", mktime(0, 0, 0, $month, 10));
        $income=Bill::whereMonth('purchase_date', '=', $month)->whereYear('purchase_date', '=', $year)->sum('grand_total');
        $unpaid=Bill::where('paid','0')->whereMonth('purchase_date', '=', $month)->whereYear('purchase_date', '=', $year)->count();
        $notvalidate=Bill::where('approved','0')->whereMonth('purchase_date', '=', $month)->whereYear('purchase_date', '=', $year)->count();
        $purchases = Bill::join('res_partners', 'purchases.client', '=', 'res_partners.id')
                            ->join('hr_employees', 'purchases.merchandise', '=', 'hr_employees.user_id')
                            ->join('partner_credit', 'purchases.purchase_no', '=', 'partner_credit.purchase_no')
                            ->select('purchases.*', 'partner_credit.payment','partner_credit.status','res_partners.partner_name','hr_employees.employee_name')
                            ->orderBy('created_at', 'desc')
                            ->whereMonth('purchases.purchase_date', '=', $month)->whereYear('purchases.purchase_date', '=', $year)
                            ->paginate(10);
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
                ->loadview('reports.purchases.purchase_report_pdf', compact('monthName','year','income','unpaid','notvalidate','purchases'));
                return $pdf->stream();
    }

    public function payment_date($value)
    {
        switch ($value) {
            case 1:
                returndate('Y-m-d H:i:s');
                break;
            case 2:
                $Date = date('Y-m-d H:i:s');
                return date('Y-m-d', strtotime($Date. ' + 15 days'));
                break;
            case 3:
                $Date = date('Y-m-d H:i:s');
                return date('Y-m-d', strtotime($Date. ' + 21 days'));
                break;
            case 4:
                $Date = date('Y-m-d H:i:s');
                return date('Y-m-d', strtotime($Date. ' + 30 days'));
                break;
            case 5:
                $Date = date('Y-m-d H:i:s');
                return date('Y-m-d', strtotime($Date. ' + 45 days'));
                break;
            case 6:
                $Date = date('Y-m-d H:i:s');
                return date('Y-m-d', strtotime($Date. ' + 2 Month'));
                break;
            case 7:
                $Date = date('Y-m-d H:i:s');
                return date("Y-m-t", strtotime($Date));
                break;
            default:
                return date('Y-m-d H:i:s');;
        }
    }

    public function wizard_create($id)
    {
        try{

            $Purchase_no = $this->calculate_code(); 
            $orders = Purchase::getPurchase($id);
            $orders_line = Purchase::getPurchaseLine($id);
            $partner = Partner::getVendor($orders->vendor);
            $address = "$partner->street,$partner->zip,$partner->city";
            $due_date = $this->payment_date($partner->payment_terms);
            $Bills = Bill::insertGetId([   
                'purchase_no'=>$Purchase_no,
                'purchase_date'=>date('Y-m-d H:i:s'),
                'due_date'=>$due_date,
                'client'=>$orders->vendor,
                'client_address'=>$address,
                'title'=>$orders->order_no,
                'merchandise'=>Auth::id(),
                'sub_total'=>$orders->sub_total,
                'discount'=>$orders->discount,
                'grand_total'=>$orders->grand_total,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            foreach($orders_line as $e => $data){
                $bill_line = BillProduct::create([
                    'purchase_id'=>$Bills,
                    'name'=>$data->name,
                    'qty'=>$data->qty,
                    'price'=>$data->price,
                    'total'=>$data->total,
                ]);
            }
            $orders->update([
                'invoice'=> True,
            ]);
            return redirect()->route('purchases.show',$Bills);    
        }catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }
}