<?php

namespace App\Http\Controllers;

use App\Models\Partner\res_partner;
use App\Models\World_database\res_country;
use App\Models\World_database\res_country_state;
use App\Models\Accounting\account_journal;
use App\Models\Human_Resource\hr_employee;
use App\Models\Data\res_partner_industry;
use App\Models\Currency\res_currency;
use App\Models\Data\res_lang;
use App\Models\Data\timezone;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\access_right;
use App\User;

class ResPartnersController extends Controller
{
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $partner = DB::table('res_partners')
                    ->join('res_country', 'res_partners.country_id', '=', 'res_country.id')
                    ->select('res_partners.*', 'res_country.country_name')
                    ->whereNull('res_partners.deleted_at')
                    ->orderBy('partner_name', 'ASC')
                    ->paginate(30);
        return view('res_partner.index',compact('access','group','partner'));
    }

    public function search(Request $request)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $key=$request->filter;
        $value=$request->value;
        if ($key!=""){
            $partner = DB::table('res_partners')
                    ->join('res_country', 'res_partners.country_id', '=', 'res_country.id')
                    ->select('res_partners.*', 'res_country.country_name')
                    ->whereNull('res_partners.deleted_at')
                    ->orderBy('partner_name', 'ASC')
                    ->where($key,'like',"%".$value."%")
                    ->paginate(30);
            $customer ->appends(['filter' => $key ,'value' => $value,'submit' => 'Submit' ])->links();
        }else{
            $partner = DB::table('res_partners')
                    ->join('res_country', 'res_partners.country_id', '=', 'res_country.id')
                    ->select('res_partners.*', 'res_country.country_name')
                    ->whereNull('res_partners.deleted_at')
                    ->orderBy('partner_name', 'ASC')
                    ->paginate(30);
        }
        return view('res_partner.index',compact('access','group','partner'));
    }

    public function create()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $employee = hr_employee::orderBy('employee_name', 'ASC')->get();
        $account = account_journal::orderBy('code','asc')->get();
        return view('res_partner.create_partner',compact('access','group','account','employee'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);
        try {
            $nama_file="";
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->getClientOriginalName();
                $nama_file = time()."_".$photo;
                $destination = base_path() . '/public/uploads/Partners';
                $request->file('photo')->move($destination, $nama_file);
            }
            $res_partner = res_partner::create([
                'partner_name'=> $request->name,
                'display_name'=> $request->name,
                'parent_id'=> $request->Parent_id,
                'ref'=> $request->reference,
                'lag'=> $request->lag,
                'tz'=> $request->tz,
                'currency_id'=> $request->currency_id,
                'bank_account'=> $request->bank_account,
                'website'=> $request->website,
                'credit_limit'=> $request->credit,
                'debit_limit'=> $request->debit,
                'active'=> $active=True,
                'address'=> $request->type,
                'street'=> $request->street1,
                'street2'=> $request->street2,
                'zip'=> $request->zip,
                'city'=> $request->city,
                'state_id'=> $request->state,
                'country_id'=> $request->country,
                'partner_latitude'=> $request->partner_latitude,
                'partner_longitude'=> $request->partner_longitude,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'mobile'=> $request->mobile,
                'industry_id'=> $request->industry_id,
                'company_name'=>$request->name,
                'commercial_company_name'=>$request->name,
                'mcd'=> $request->mcd,
                'payment_terms'=>$request->payment_terms,
                'note'=>$request->note,
                'receivable_account'=>$request->receivable_account,
                'logo'=> $nama_file,
            ]);
            Toastr::success('Vendors ' .$request->name. ' created successfully','Success');
            return redirect(route('partner'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    public function show(res_partner $res_partner)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $employee = hr_employee::orderBy('employee_name', 'ASC')->get();
        $account = account_journal::orderBy('code','asc')->get();
        $country=res_country::orderBy('country_name', 'ASC')->get();
        $state=res_country_state::orderBy('state_name', 'ASC')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        $lang = res_lang::orderBy('lang_name', 'ASC')->get();
        $tz = timezone::orderBy('timezone', 'ASC')->get();
        $industry= res_partner_industry::orderBy('industry_name', 'ASC')->get();
        return view('res_partner.edit_partner',
            compact('access','group','res_partner','country','state','currency','lang','tz','industry','account','employee'));
    }

    public function edit(res_partner $res_partner)
    {
        //
    }

    public function update(Request $request, res_partner $res_partner)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:products',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);
        try {
            $res_partner = res_partner::where('id',$request->id)->first();
            $nama_file=$res_partner->logo;
            $debit_limit=$res_partner->debit_limit;
            $credit_limit=$res_partner->credit_limit;
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->getClientOriginalName();
                $nama_file = time()."_".$photo;
                $destination = base_path() . '/public/uploads/Partners';
                $request->file('photo')->move($destination, $nama_file);
            }
            $res_partner = res_partner::where('id',$request->id)->update([
                'partner_name'=> $request->name,
                'display_name'=> $request->name,
                'parent_id'=> $request->Parent_id,
                'ref'=> $request->reference,
                'lag'=> $request->lag,
                'tz'=> $request->tz,
                'currency_id'=> $request->currency_id,
                'bank_account'=> $request->bank_account,
                'website'=> $request->website,
                'active'=> $active=True,
                'address'=> $request->type,
                'street'=> $request->street1,
                'street2'=> $request->street2,
                'zip'=> $request->zip,
                'city'=> $request->city,
                'state_id'=> $request->state,
                'country_id'=> $request->country,
                'partner_latitude'=> $request->partner_latitude,
                'partner_longitude'=> $request->partner_longitude,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'mobile'=> $request->mobile,
                'industry_id'=> $request->industry_id,
                'company_name'=>$request->name,
                'commercial_company_name'=>$request->name,
                'mcd'=> $request->mcd,
                'payment_terms'=>$request->payment_terms,
                'note'=>$request->note,
                'receivable_account'=>$request->receivable_account,
                'logo'=> $nama_file,
            ]);
            Toastr::success('Vendors ' .$request->name. ' created successfully','Success');
            return redirect(route('partner'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    public function destroy(res_partner $res_partner)
    {
        $partner = res_partner::where('id',$res_partner->id);
        $partner->delete();
        $message="partner data with name '$res_partner->id' Has been Delete successfully " ;
        return redirect('/partner')->with('status', $message);
    }

    public function searchapi(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $partner = res_partner::where('id', $request->id)->first();
        if ($partner) {
            return response()->json([
                'status' => 'success',
                'data' => $partner
            ], 200);
        }
        return response()->json([
            'status' => 'failed',
            'data' => []
        ]);
    }
}
