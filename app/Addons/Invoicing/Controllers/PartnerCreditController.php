<?php

namespace App\Addons\Invoicing\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Invoicing\Models\partner_credit;
use App\Addons\Contact\Models\res_partner;
use Illuminate\Http\Request;
use Auth;
use Invoicing;

class PartnerCreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partner = res_partner::orderBy('partner_name', 'asc')->where('debit','>',0)->paginate(10);
        return view('partner_dept.index', compact('access'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\partner_credit  $partner_credit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partnerdebt = partner_credit::join('res_partners', 'partner_credit.partner_id', '=', 'res_partners.id')
                                        ->select('partner_credit.*', 'res_partners.partner_name')
                                        ->orderBy('purchase_date', 'asc')
                                        ->where([ ['status', 'UNPAID'],['partner_id',$id] ])->paginate(10);
        return view('partner_dept.show', compact('partnerdebt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\partner_credit  $partner_credit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partner_debt = partner_credit::join('res_partners', 'partner_credit.partner_id', '=', 'res_partners.id')
                                        ->select('partner_credit.*', 'res_partners.partner_name','res_partners.credit')
                                        ->where('purchase_no', $id)->get();
        return view('partner_dept.edit', compact('partner_debt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\partner_credit  $partner_credit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, partner_credit $partner_credit)
    {
        try {
            $partner_debt = partner_credit::where('purchase_no',$request->purchase_no);
            $partner_debt->update([
                    'payment' => $request->payment,
                    'over' => $request->over,
                    'status' => $request->status,
            ]);
            $purchase = Invoicing::getBillByPurchaseNo($request->purchase_no);
            $purchase->update([
                'paid'=> True,
            ]);
            $partner = res_partner::findOrFail($request->partner_id);
            $debit = $partner->debit; 
            $debit = $debit - $request->payment;
            $partner->update([
                'credit' => $request->over,
                'debit'=> $debit,
            ]);

            return redirect(route('PartnerDebt'))
                ->with(['success' => 'Payment Inoice No:<strong>' . $request->purchase_no . '</strong> created succesfully']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\partner_credit  $partner_credit
     * @return \Illuminate\Http\Response
     */
    public function destroy(partner_credit $partner_credit)
    {
        //
    }
}
