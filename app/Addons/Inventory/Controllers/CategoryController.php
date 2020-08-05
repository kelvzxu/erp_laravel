<?php

namespace App\Addons\Inventory\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Inventory\Models\category;
use Illuminate\Http\Request;
use Inventory;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = category::orderBy('created_at', 'DESC')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
        ]);

        $complete_name = $request->name;
        if ($request->parent_id != "")
        {
            $parent = category::findOrFail($request->parent_id);
            $complete_name = "$parent->complete_name / $request->name";
        }

        try {
            category::create([
                'name' =>$request->name,
                'complete_name' =>$complete_name,
                'parent_id'=> $request->parent_id,
                'description' =>$request->description,
                'removal_strategy_id' =>$request->removal_strategy_id,
                'costing_method' =>$request->costing_method,
                'create_uid'=>$request->create_uid,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "Category $request->name Updated Successfully"
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $categories = category::findOrFail($request->id);
        $categories->delete();
        return redirect(route('product-categories'))->with(['success' => 'data berhasil Telah Dihapus']);
    }

    public function edit($id)
    {
        $categories = category::findOrFail($id);
        return view('categories.edit', compact('categories'));
    }

    public function update(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            $categories = category::where('id',$request->id)->update([
                'name' => $request->name,
                'description' => $request->description
            ]);
            return redirect(route('product-categories'))->with(['success' => 'Kategori: '.$request->name.' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function fetchCategory(){
        try {
            $products = Inventory::categories();
            return response()->json([
                'status' => 'success',
                'result' => $products
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'result' => []
            ]);
        }
    }
    public function getCategory($id){
        try {
            $response = category::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'result' => $response
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'result' => []
            ]);
        }
   }
}
