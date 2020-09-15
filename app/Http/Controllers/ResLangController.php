<?php

namespace App\Http\Controllers;

use App\Models\Data\res_lang;
use Illuminate\Http\Request;

class ResLangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return res_lang::orderBy('lang_name', 'ASC')->where('active',true)->get();
    }

    public function CountActiveLang(){
        try {
            $response = res_lang::where('active',true)->count();
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

    public function FetchLang(){
        try {
            $response = res_lang::orderBy('active', 'ASC')->orderBy('lang_name', 'ASC')->get();
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

    public function GetLang(Request $request)
    {
        $response = res_lang::findorFail($request->id);
        if ($response) {
            return response()->json([
                'status' => 'success',
                'result' => $response
            ], 200);
        }
        return response()->json([
            'status' => 'failed',
            'result' => []
        ]);
    }

    public function activate(Request $request){
        try{
            $lang = res_lang::findorFail($request->id)->update([
                'active'=>true
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "The selected language has been successfully installed. You must change the preferences of the user to view the changes. "
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }

    }
}
