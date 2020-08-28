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
    function UploadFile($name, $photo)
    {
        $extension = explode('/', explode(':', substr($photo, 0, strpos($photo, ';')))[1])[1];
        $replace = substr($photo, 0, strpos($photo, ',')+1); 
        $image = str_replace($replace, '', $photo); 
        $image = str_replace(' ', '+', $image); 
        $imageName = time() .'_'.str_replace(' ','_',$name).'.'.$extension;
        $path = public_path('uploads/Products');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        file_put_contents(public_path('uploads/Products/').$imageName,base64_decode($image));
        return $imageName;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string|max:10|unique:products',
            'name' => 'required|string|max:100',
            'barcode' => 'required|string|max:10|unique:products',
            'price' => 'required|integer',
            'category_id' => 'required|exists:product_categories,id',
        ]);
        $image_64 = $request->photo;
        $imageName = null;
        if ($image_64 != ""){
            $imageName = $this->UploadFile($request->name,$image_64);
        }
        try { 

            $data = $request->all();
            $data['photo'] = $imageName;

            $product = product::create($data);
            return response()->json([
                'status' => 'success',
                'message' => "Product $request->name Created Successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string|max:10|exists:products,code',
            'name' => 'required|string|max:100',
            'barcode' => 'required|string|max:10|exists:products,barcode',
            'price' => 'required|integer',
            'category_id' => 'required|exists:product_categories,id',
        ]);
        $product = product::findorFail($request->id);
        $image_64 = $request->photo;
        $imageName = $product->photo;
        if ($image_64 != ""){
            $imageName = $this->UploadFile($request->name,$image_64);
            if (!empty($product->photo)) {
                File::delete(public_path('uploads/Products/' . $product->photo));
            }
        }
        try {
            $data = $request->all();
            $data['photo'] = $imageName;

            $product->update($data);
            return response()->json([
                'status' => 'success',
                'message' => "Product $request->name Updated Successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function UpdateCost(Request $request){
        echo "update Costing";
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

    public function ProductBuy()
    {
        try {
            $products = Inventory::can_be_purchase();
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

        $product = product::with('stock','uom','uom_po','category')->where('id', $request->id)->first();
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
