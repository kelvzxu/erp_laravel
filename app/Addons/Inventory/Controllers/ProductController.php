<?php

namespace App\Addons\Inventory\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Inventory\Models\product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use File;
use PDF;
use Accounting;
use Inventory;

class ProductController extends Controller
{
    public function index()
    {
        $products = product::with('category')->orderBy('name', 'ASC')->paginate(30);
        return view('products.index', compact('products'));
    }

    public function search(Request $request)
    {
        $key=$request->filter;
        $value=$request->value;
        if ($key!=""){
            $products = product::with('category')
                    ->where($key,'like',"%".$value."%")
                    ->orderBy('name', 'ASC')
                    ->paginate(10);
            $products ->appends(['filter' => $key ,'value' => $value,'submit' => 'Submit' ])->links();
        }else{
            $products = product::with('category')->orderBy('name', 'ASC')->paginate(30);
        }
        return view('products.index',compact('products'));
    }

    public function create()
    {
        $categories = Inventory::categories();
        $account = Accounting::account_account();
        $journal = Accounting::account_journal();
        return view('products.create', compact('categories','journal','account'));
    }

    public function store(Request $request)
    {
        $image_64 = $request->photo;
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
        $image = str_replace($replace, '', $image_64); 
        $image = str_replace(' ', '+', $image); 
        $imageName = time() . '.'.$extension;
        $path = public_path('uploads/Products');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        // $image = $request->get('photo');
        // $imageName = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        file_put_contents(public_path('uploads/Products/').$imageName,base64_decode($image));
        echo $extension;
 
        
            //     $photo = $request->file('photo')->getClientOriginalName();
            //     $nama_file = time()."_".$photo;
            //     $destination = base_path() . '/public/uploads/product';
            //     $request->file('photo')->move($destination, $nama_file);
            // }
            // echo "hasil: ";
            // echo $request->file('photo')->getClientOriginalName();

        // $this->validate($request, [
        //     'code' => 'required|string|max:10|unique:products',
        //     'name' => 'required|string|max:100',
        //     'description' => 'nullable|string|max:100',
        //     'price' => 'required|integer',
        //     'category_id' => 'required|exists:categories,id',
        //     'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        // ]);

        // try {

        //     $product = product::create([
        //         'code' => $request->code,
        //         'name' => $request->name,
        //         'description' => $request->description,
        //         'stock' => "0",
        //         'price' => $request->price,
        //         'category_id' => $request->category_id,
        //         'barcode' => $request->barcode,
        //         'photo' => $nama_file,
        //         'cost'=>$request->cost,
        //         'can_be_sold'=>$request->can_be_sold,
        //         'can_be_purchase'=>$request->can_be_purchase,
        //         'income_account'=>$request->income_account,
        //         'expense_account'=>$request->expense_account,
        //         'stock_input_account'=>$request->stock_input_account,
        //         'stock_output_account'=>$request->stock_output_account,
        //         'stock_valuation_account'=>$request->stock_valuation_account,
        //         'stock_journal'=>$request->stock_journal,
        //         'location'=>1,
        //     ]);
        //     return redirect(route('product'))
        //         ->with(['success' => '<strong>' . $product->name . '</strong> Ditambahkan']);
        // } catch (\Exception $e) {
        //     return redirect()->back()
        //         ->with(['error' => $e->getMessage()]);
        // }
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
        $products = product::find($id);
        if (!empty($products->photo)) {
            File::delete(public_path('uploads/product/' . $products->photo));
        }
        $products->delete();
        Toastr::success('Product ' . $products->name . ' Delete Successfully','Success');
                return redirect(route('product'));
    }

    public function edit(Request $request)
    {
        $product = Inventory::getProduct($request->id);
        $categories = Inventory::categories();
        $account = Accounting::account_account();
        $journal = Accounting::account_journal();
        return view('products.edit', compact('product', 'categories','journal','account'));
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
            $product = product::where('code',$request->code)->first();
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

        $product = product::where('id', $request->id)->first();
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

        $product = product::where('barcode', $request->s)->first();
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
        $products = Inventory::products();
    	$pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadview('reports.product.product_list', compact('products'));
    	return $pdf->stream();
    }

    public function stock_report()
    {
        $products = Inventory::products();
    	$pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadview('reports.product.product_stock', compact('products'));
    	return $pdf->stream();
    }

    public function Products()
    {
        try {
            $products = Inventory::products();
            return response()->json([
                'status' => 'success',
                'data' => $products
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'data' => []
            ]);
        }
    }

    public function ProductSale()
    {
        try {
            $products = Inventory::can_be_sold();
            return response()->json([
                'status' => 'success',
                'data' => $products
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'data' => []
            ]);
        }
    }

    public function getProductById(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $product = product::where('id', $request->id)->first();
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
}
