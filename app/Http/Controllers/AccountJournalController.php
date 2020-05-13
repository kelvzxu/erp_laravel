<?php

namespace App\Http\Controllers;

use App\Models\Currency\res_currency;
use App\Models\Accounting\account_account;
use App\Models\Accounting\account_journal;
use App\Models\Accounting\account_account_type;
use App\Models\Company\res_company;
use App\Models\Company\res_bank;
use App\Models\Company\res_Company_bank;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\access_right;
use App\User;

class AccountJournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $journal = account_journal::with('company')->orderBy('name', 'ASC')->paginate(25);
        return view ('accounting.journal.index',compact('journal','access','group'));
    }

    public function search(Request $request)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $key=$request->filter;
        $value=$request->value;
        try {
            if ($key!=""){
                $journal = account_journal::orderBy('code', 'ASC')
                        ->where($key,'like',"%".$value."%")
                        ->paginate(25);
                $journal->appends(['filter' => $key ,'value' => $value,'submit' => 'Submit' ])->links();
            }else{
                $journal = account_journal::orderBy('code', 'ASC')
                        ->paginate(25);
            }
            return view('accounting.journal.index',compact('journal','access','group'));
        }catch (\Exception $e) {
            // Toastr::error($e->getMessage(),'Something Wrong');
            Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    public function create()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $company = res_company::orderBy('id','asc')->get();
        $account = account_account::orderBy('code','asc')->get();
        $bank_account = res_Company_bank::orderBy('company_bank_name','asc')->get();
        $bank = res_bank::orderBy('bank_name','asc')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        $account_type = account_account_type::orderBy('id', 'ASC')->get();
        return view ('accounting.journal.create',
        compact('company','currency','account','account_type','bank_account','bank','access','group'));
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
            'code' => 'required',
            'name' => 'required|string|max:50',
            'type' => 'required',
            'currency_id' => 'required',
            'company_id' => 'required',
        ]);
        try {
            $journal = account_journal::create([
                'name'=> $request->name,
                'code'=> $request->code,
                'active'=> True,
                'type'=> $request->type,
                'currency_id'=> $request->currency_id,
                'company_id'=> $request->company_id,
                'default_credit_account_id'=> $request->default_credit_account_id,
                'default_debit_account_id'=> $request->default_debit_account_id,
                'profit_account_id'=> $request->profit_account_id,
                'loss_account_id'=> $request->loss_account_id,
                'post_at'=> $request->post_at,
                'account_type_allowed'=> $request->account_type_allowed,
                'account_allowed'=> $request->account_allowed,
                'bank_account_id'=> $request->bank_account_id,
                'bank'=> $request->bank,
            ]);
            Toastr::success('Journal Creation Successfully','Success');
            return redirect(route('journal.index'));
        } catch (\Exception $e) {
            // Toastr::error($e->getMessage(),'Something Wrong');
            Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\account_journal  $account_journal
     * @return \Illuminate\Http\Response
     */
    public function show(account_journal $account_journal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\account_journal  $account_journal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $bank_account = res_Company_bank::orderBy('company_bank_name','asc')->get();
        $bank = res_bank::orderBy('bank_name','asc')->get();
        $journal = account_journal::findOrFail($id);
        $company = res_company::orderBy('id','asc')->get();
        $account = account_account::orderBy('code','asc')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        $account_type = account_account_type::orderBy('id', 'ASC')->get();
        return view ('accounting.journal.edit',
        compact('journal','company','currency','account','account_type','bank_account','bank','access','group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\account_journal  $account_journal
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required|string|max:50',
            'type' => 'required',
            'currency_id' => 'required',
            'company_id' => 'required',
        ]);
        try {
            $journal = account_journal::where('id',$id)->update([
                'name'=> $request->name,
                'code'=> $request->code,
                'active'=> True,
                'type'=> $request->type,
                'currency_id'=> $request->currency_id,
                'company_id'=> $request->company_id,
                'default_credit_account_id'=> $request->default_credit_account_id,
                'default_debit_account_id'=> $request->default_debit_account_id,
                'profit_account_id'=> $request->profit_account_id,
                'loss_account_id'=> $request->loss_account_id,
                'post_at'=> $request->post_at,
                'account_type_allowed'=> $request->account_type_allowed,
                'account_allowed'=> $request->account_allowed,
                'bank_account_id'=> $request->bank_account_id,
                'bank'=> $request->bank,
            ]);
            Toastr::success('Journal Creation Successfully','Success');
            return redirect(route('journal.index'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\account_journal  $account_journal
     * @return \Illuminate\Http\Response
     */
    public function destroy(account_journal $account_journal)
    {
        //
    }
}
