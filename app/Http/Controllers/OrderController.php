<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\OrderInvoice;
use Carbon\Carbon;
use App\Models\Customer\res_customer;
use App\Models\Product\Product;
use App\Models\Sales\Order;
use App\User;
use Cookie;
use DB;
use PDF;

class OrderController extends Controller
{
    public function addOrder()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('orders.add', compact('products'));
    }

    public function getProduct($id)
    {
        $products = Product::findOrFail($id);
        return response()->json($products, 200);
    }

    public function addToCart(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer'
        ]);
        
        $product = Product::findOrFail($request->product_id);
        $getCart = json_decode($request->cookie('cart'), true);

        if ($getCart) {
            if (array_key_exists($request->product_id, $getCart)) {
                $getCart[$request->product_id]['qty'] += $request->qty;
                return response()->json($getCart, 200)
                    ->cookie('cart', json_encode($getCart), 120);
            } 
        }

        $getCart[$request->product_id] = [
            'code' => $product->code,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => $request->qty
        ];
        return response()->json($getCart, 200)
            ->cookie('cart', json_encode($getCart), 120);
    }

    public function getCart()
    {
        $cart = json_decode(request()->cookie('cart'), true);
        return response()->json($cart, 200);
    }

    public function removeCart($id)
    {
        $cart = json_decode(request()->cookie('cart'), true);
        unset($cart[$id]);
        return response()->json($cart, 200)->cookie('cart', json_encode($cart), 120);
    }

    public function checkout()
    {
        return view('orders.checkout');
    }

    public function storeOrder(Request $request)
    {
        // echo $request->id;
        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'name' => 'required|string|max:100',
        //     'address' => 'required',
        //     'phone' => 'required|numeric'
        // ]);

        $cart = json_decode($request->cookie('cart'), true);
        var_dump($cart);
    }

    public function generateInvoice()
    {
        $order = Order::orderBy('created_at', 'DESC');
        if ($order->count() > 0) {
            $order = $order->first();
            $explode = explode('-', $order->invoice);
            $count = $explode[1] + 1;
            return 'INV-' . $count;
        }
        return 'INV-1';
    }

    public function index(Request $request)
    {
        $customers = res_customer::orderBy('name', 'ASC')->get();
        $users = User::role('kasir')->orderBy('name', 'ASC')->get();
        $orders = Order::orderBy('created_at', 'DESC')->with('order_detail', 'customer');

        if (!empty($request->customer_id)) {
            $orders = $orders->where('customer_id', $request->customer_id);
        }

        if (!empty($request->user_id)) {
            $orders = $orders->where('user_id', $request->user_id);
        }
        
        if (!empty($request->start_date) && !empty($request->end_date)) {
            $this->validate($request, [
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date'
            ]);
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01';
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59';

            $orders = $orders->whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            $orders = $orders->take(10)->skip(0)->get();
        }

        return view('orders.index', [
            'orders' => $orders,
            'sold' => $this->countItem($orders),
            'total' => $this->countTotal($orders),
            'total_customer' => $this->countCustomer($orders),
            'customers' => $customers,
            'users' => $users
        ]);
    }

    private function countCustomer($orders)
    {
        $customer = [];
        if ($orders->count() > 0) {
            foreach ($orders as $row) {
                $customer[] = $row->customer->email;
            }
        }
        return count(array_unique($customer));
    }

    private function countTotal($orders)
    {
        $total = 0;
        if ($orders->count() > 0) {
            $sub_total = $orders->pluck('total')->all();
            $total = array_sum($sub_total);
        }
        return $total;
    }

    private function countItem($order)
    {
        $data = 0;
        if ($order->count() > 0) {
            foreach ($order as $row) {
                $qty = $row->order_detail->pluck('qty')->all();
                $val = array_sum($qty);
                $data += $val;
            }
        } 
        return $data;
    }

    public function invoicePdf($invoice)
    {
        $order = Order::where('invoice', $invoice)
            ->with('customer', 'order_detail', 'order_detail.product')->first();
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadView('orders.report.invoice', compact('order'));
        return $pdf->stream();
    }

    public function invoiceExcel($invoice)
    {
        return (new OrderInvoice($invoice))->download('invoice-' . $invoice . '.xlsx');
    }
}
