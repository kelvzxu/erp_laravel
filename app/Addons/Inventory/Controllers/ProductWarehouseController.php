<?php

namespace App\Addons\Inventory\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Inventory\Models\product_warehouse;
use Illuminate\Http\Request;

class ProductWarehouseController extends Controller
{
    public function FetchWarehouse(){
        try {
            $response = product_warehouse::with('company')->get();
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
    public function getWarehouse($request){
        try {
            $response = product_warehouse::findorFail($request);
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'code' => 'required|string|max:5|unique:product_warehouses',
        ]);

        try {
            product_warehouse::create([
                'name' =>ucwords($request->name),
                'code' =>strtoupper($request->code),
                'company_id' =>$request->company_id,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "Warehouse $request->name Updated Successfully"
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'code' => 'required|string|max:5|exists:product_warehouses,code',
        ]);

        try {
            product_warehouse::findorFail($request->id)->update([
                'name' =>ucwords($request->name),
                'code' =>strtoupper($request->code),
                'company_id' =>$request->company_id,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "Warehouse $request->name Updated Successfully"
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
