<?php

namespace App\Addons\Accounting\Controllers;

use App\Models\Company\res_company;
use App\Models\Currency\res_currency;
use App\Addons\Accounting\Models\account_account;
use App\Addons\Accounting\Models\account_account_type;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\controller as Controller;

class AccountAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = account_account::with('company','account_type')->orderBy('code', 'ASC')->paginate(25);
        return view ('accounting.account.index',compact('account'));
    }

    public function search(Request $request)
    {
        $key=$request->filter;
        $value=$request->value;
        if ($key!=""){
            $account = account_account::orderBy('code', 'ASC')
                    ->where($key,'like',"%".$value."%")
                    ->paginate(25);
            $account->appends(['filter' => $key ,'value' => $value,'submit' => 'Submit' ])->links();
        }else{
            $account = account_account::orderBy('code', 'ASC')
                    ->paginate(25);
        }
        return view('accounting.account.index',compact('account'));
    }

    public function create()
    {
        $account_type = account_account_type::orderBy('id', 'ASC')->get();
        $company = res_company::orderBy('id','asc')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        return view ('accounting.account.create',compact('account_type','company','currency'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:account_accounts',
            'name' => 'required|string|max:50',
            'type' => 'required',
            'currency_id' => 'required',
            'company_id' => 'required',
        ]);
        try {
            $account = account_account::create([
                'name'=> $request->name,
                'currency_id'=> $request->currency_id,
                'code'=> $request->code,
                'deprecated'=> $request->deprecated,
                'type'=> $request->type,
                'internal_type'=> $request->internal_type,
                'internal_group'=> $request->internal_group,
                'reconcile'=> $request->reconcile,
                'company_id'=> $request->company_id,
            ]);
            Toastr::success('Chart Of Account Creation Successfully','Success');
            return redirect(route('account.index'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\account_account  $account_account
     * @return \Illuminate\Http\Response
     */
    public function show(account_account $account_account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\account_account  $account_account
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = account_account::findOrFail($id);
        $account_type = account_account_type::orderBy('id', 'ASC')->get();
        $company = res_company::orderBy('id','asc')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        return view ('accounting.account.edit',compact('account','account_type','company','currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\account_account  $account_account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, account_account $account_account)
    {
        $this->validate($request, [
            'code' => 'required|unique:account_accounts',
            'name' => 'required|string|max:50',
            'type' => 'required',
            'currency_id' => 'required',
            'company_id' => 'required',
        ]);
        try {
            $account = account_account::where('code',$request->code)->update([
                'name'=> $request->name,
                'currency_id'=> $request->currency_id,
                'deprecated'=> $request->deprecated,
                'type'=> $request->type,
                'internal_type'=> $request->internal_type,
                'internal_group'=> $request->internal_group,
                'reconcile'=> $request->reconcile,
                'company_id'=> $request->company_id,
            ]);
            Toastr::success('Chart Of Account update Successfully','Success');
            return redirect(route('account.index'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\account_account  $account_account
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = account_account::find($id);
        $account -> delete();
        Toastr::success('Chart Of Account ' .$account->name. ' |  ' .$account->code. ' Deleted Successfully','Success');
            return redirect(route('account.index'));
    }

    public function fetchAccountAccounts(){
        $response = account_account::orderBy('code', 'ASC')->get();
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
}
