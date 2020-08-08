<?php

namespace App\Addons\Uom\Controllers;

use App\Addons\Uom\Models\uom_uom;
use App\Addons\Uom\Models\uom_category;
use App\Addons\Uom\Models\uom_type;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class UomController extends Controller
{
   public function fetchUom(){
        try {
            $response = uom_uom::with('category','type')
                    ->orderBy('created_at', 'desc')
                    ->get();
            return response()->json([
                'status' => 'success',
                'data' => $response
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'data' => []
            ]);
        }
   }
   public function fetchUomByCategory($id){
        try {
            $response = uom_uom::with('category','type')
                    ->where('category_id',$id)
                    ->orderBy('created_at', 'desc')
                    ->get();
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
   public function fetchUomCategory(){
        try {
            $response = uom_category::orderBy('id', 'asc')
                    ->get();
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
   public function fetchUomType(){
        try {
            $response = uom_type::orderBy('id', 'asc')
                    ->get();
            return response()->json([
                'status' => 'success',
                'result' => $response,
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'result' => []
            ]);
        }
   }

   public function getUom($id){
        try {
            $response = uom_uom::with('category','type')
                    ->findOrFail($id);
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

   public function store(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'category_id'=>'required',
            'factor'=>'required',
            'rounding'=>'required',
            'active'=>'required',
            'uom_type'=>'required',
        ]);

        $validator=0;
        // check uom_type
        if ($request->uom_type == 'reference'){
            $uom =uom_uom::where('category_id',$request->category_id)
                        ->where('uom_type',$request->uom_type)
                        ->count();
            $validator = $uom;
        }
        if ($validator == 0){
            $category = uom_category::findOrFail($request->category_id);
            $measure_type = $category->measure_type;
            uom_uom::create([
                'name'=>$request->name,
                'category_id'=>$request->category_id,
                'factor'=>$request->factor,
                'rounding'=>$request->rounding,
                'active'=>$request->active,
                'uom_type'=>$request->uom_type,
                'measure_type'=>$measure_type,
                'create_uid' =>$request->create_uid,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Uom Created Successfully'
            ]);
        }
   }
   
   public function update(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'category_id'=>'required',
            'factor'=>'required',
            'rounding'=>'required',
            'uom_type'=>'required',
        ]);
        $validator=0;
        $uom= uom_uom::findorFail($request->id);
        if ($uom->uom_type != 'reference'){
            // check uom_type
            if ($request->uom_type == 'reference'){
                $uom =uom_uom::where('category_id',$request->category_id)
                            ->where('uom_type',$request->uom_type)
                            ->count();
                $validator = $uom;
            }
        }
        if ($validator == 0){
            $category = uom_category::findOrFail($request->category_id);
            $measure_type = $category->measure_type;
            uom_uom::findOrFail($request->id)->update([
                'name'=>$request->name,
                'category_id'=>$request->category_id,
                'factor'=>$request->factor,
                'rounding'=>$request->rounding,
                'active'=>$request->active,
                'uom_type'=>$request->uom_type,
                'measure_type'=>$measure_type,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "Uom $request->name Updated Successfully"
            ]);
        }
        else{
            return response()->json([
                'status' => 'failed',
                'message' => 'UoM category Unit should only have one reference unit of measure.'
            ]);
        }
   }
}
