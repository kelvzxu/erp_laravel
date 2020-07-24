<?php

namespace App\Http\Controllers;

use App\access_right;
use App\User;
use App\Models\Accounting\account_account;
use App\Models\Accounting\account_journal;
use App\Models\Currency\res_currency;
use App\Models\Product\Category;
use App\Models\Product\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use File;
use PDF;

class ProductController extends Controller
{
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $products = Product::with('category')->orderBy('name', 'ASC')->paginate(30);
        return view('products.index', compact('access','group','products'));
    }

    public function search(Request $request)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $key=$request->filter;
        $value=$request->value;
        if ($key!=""){
            $products = Product::with('category')
                    ->where($key,'like',"%".$value."%")
                    ->orderBy('name', 'ASC')
                    ->paginate(10);
            $products ->appends(['filter' => $key ,'value' => $value,'submit' => 'Submit' ])->links();
        }else{
            $products = Product::with('category')->orderBy('name', 'ASC')->paginate(30);
        }
        return view('products.index',compact('access','group','products'));
    }

    public function create()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $categories = Category::orderBy('name', 'ASC')->get();
        $account = account_account::orderBy('code','asc')->get();
        $journal = account_journal::orderBy('code','asc')->get();
        return view('products.create', compact('access','group','categories','journal','account'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string|max:10|unique:products',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
            'price' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $nama_file = null;
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->getClientOriginalName();
                $nama_file = time()."_".$photo;
                $destination = base_path() . '/public/uploads/product';
                $request->file('photo')->move($destination, $nama_file);
            }

            $product = Product::create([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'stock' => "0",
                'price' => $request->price,
                'category_id' => $request->category_id,
                'barcode' => $request->barcode,
                'photo' => $nama_file,
                'cost'=>$request->cost,
                'can_be_sold'=>$request->can_be_sold,
                'can_be_purchase'=>$request->can_be_purchase,
                'income_account'=>$request->income_account,
                'expense_account'=>$request->expense_account,
                'stock_input_account'=>$request->stock_input_account,
                'stock_output_account'=>$request->stock_output_account,
                'stock_valuation_account'=>$request->stock_valuation_account,
                'stock_journal'=>$request->stock_journal,
                'location'=>1,
            ]);
            return redirect(route('product'))
                ->with(['success' => '<strong>' . $product->name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    private function saveFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/product');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }
 
    public function destroy($id)
    {
        $products = Product::find($id);
        if (!empty($products->photo)) {
            File::delete(public_path('uploads/product/' . $products->photo));
        }
        $products->delete();
        Toastr::success('Product ' . $products->name . ' Delete Successfully','Success');
                return redirect(route('product'));
    }

    public function edit(Request $request)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $product = Product::findOrFail($request->id);
        $categories = Category::orderBy('name', 'ASC')->get();
        $account = account_account::orderBy('code','asc')->get();
        $journal = account_journal::orderBy('code','asc')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        return view('products.edit', compact('access','group','product', 'categories','journal','account'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string|max:10|exists:products,code',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
            'price' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $product = Product::where('code',$request->code)->first();
            $nama_file = $product->photo;

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->getClientOriginalName();
                $nama_file = time()."_".$photo;
                $destination = base_path() . '/public/uploads/product';
                $request->file('photo')->move($destination, $nama_file);
            }


            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price, 
                'category_id' => $request->category_id,
                'barcode'=> $request->barcode,
                'cost'=>$request->cost,
                'photo' => $nama_file,
                'can_be_sold'=>$request->can_be_sold,
                'can_be_purchase'=>$request->can_be_purchase,
                'income_account'=>$request->income_account,
                'expense_account'=>$request->expense_account,
                'stock_input_account'=>$request->stock_input_account,
                'stock_output_account'=>$request->stock_output_account,
                'stock_valuation_account'=>$request->stock_valuation_account,
                'stock_journal'=>$request->stock_journal,
            ]);

            return redirect(route('product'))
                ->with(['success' => '<strong>' . $product->name . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
    public function searchapi(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $product = Product::where('id', $request->id)->first();
        if ($product) {
            return response()->json([
                'status' => 'success',
                'data' => $product
            ], 200);
        }
        return response()->json([
            'status' => 'failed',
            'data' => []
        ]);
    }
    public function getProduct(Request $request)
    {
        $this->validate($request, [
            's' => 'required'
        ]);

        $product = Product::where('barcode', $request->s)->first();
        if ($product) {
            return response()->json([
                'status' => 'success',
                'data' => $product
            ], 200);
        }
        return response()->json([
            'status' => 'failed',
            'data' => []
        ]);
    }

    public function product_report()
    {
        $products = Product::with('category')->orderBy('name', 'ASC')->get();
    	$pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadview('reports.product.product_list', compact('products'));
    	return $pdf->stream();
    }

    public function stock_report()
    {
        $products = Product::with('category')->orderBy('name', 'ASC')->get();
    	$pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadview('reports.product.product_stock', compact('products'));
    	return $pdf->stream();
    }

    public function Products()
    {
        try {
            $product = Product::with('category')->orderBy('name', 'ASC')->get();
            return response()->json([
                'status' => 'success',
                'data' => $product
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'data' => []
            ]);
        }
    }
}
