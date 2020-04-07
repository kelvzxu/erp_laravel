<?php

namespace App\Http\Controllers;

use App\Models\Partner\res_partner;
use App\Models\World_database\res_country;
use App\Models\World_database\res_country_state;
use App\Models\Data\res_partner_industry;
use App\Models\Currency\res_currency;
use App\Models\Data\res_lang;
use App\Models\Data\timezone;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ResPartnersController extends Controller
{
    public function index()
    {
        $partner = DB::table('res_partners')
                    ->join('res_country', 'res_partners.country_id', '=', 'res_country.id')
                    ->select('res_partners.*', 'res_country.country_name')
                    ->whereNull('res_partners.deleted_at')
                    ->orderBy('partner_name', 'ASC')
                    ->paginate(10);
        return view('res_partner.index',compact('partner'));
    }

    public function search(Request $request)
    {
        $key=$request->filter;
        $value=$request->value;
        echo "$key $value";
        if ($key!=""){
            $partner = DB::table('res_partners')
                    ->join('res_country', 'res_partners.country_id', '=', 'res_country.id')
                    ->select('res_partners.*', 'res_country.country_name')
                    ->whereNull('res_partners.deleted_at')
                    ->orderBy('partner_name', 'ASC')
                    ->where($key,'like',"%".$value."%")
                    ->paginate(10);
            $customer ->appends(['filter' => $key ,'value' => $value,'submit' => 'Submit' ])->links();
        }else{
            $partner = DB::table('res_partners')
                    ->join('res_country', 'res_partners.country_id', '=', 'res_country.id')
                    ->select('res_partners.*', 'res_country.country_name')
                    ->whereNull('res_partners.deleted_at')
                    ->orderBy('partner_name', 'ASC')
                    ->paginate(10);
        }
        return view('res_partner.index',compact('partner'));
    }

    public function create()
    {
        return view('res_partner.create_partner');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:products',
            'display_name' => 'required|string|max:50',
            'Parent_id' => 'nullable|string|max:100',
            'industry_id' => 'required|integer',
            'address' => 'required|string',
            'email' => 'nullable|string|max:100',
            'street1' => 'nullable|string|max:100',
            'street2' => 'nullable|string|max:100',
            'mobile' => 'nullable|string|max:100',
            'country' => 'required|integer',
            'currency_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);
        try {
            $nama_file="";
            $photo = null;
            if ($request->hasFile('image')) {
                $photo = $request->file('image')->getClientOriginalName();
                $nama_file = time()."_".$photo;
                $destination = base_path() . '/public/uploads/Partners';
                $request->file('image')->move($destination, $nama_file);
            }
            $res_partner = res_partner::create([
                'partner_name'=> $request->name,
                'display_name'=> $request->display_name,
                'title'=> $request->code,
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
                'address'=> $request->address,
                'street'=> $request->street1,
                'zip'=> $request->zip,
                'city'=> $request->street2,
                'state_id'=> $request->state,
                'country_id'=> $request->country,
                'partner_latitude'=> $request->partner_latitude,
                'partner_longitude'=> $request->partner_longitude,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'mobile'=> $request->mobile,
                'industry_id'=> $request->industry_id,
                'company_name'=>$request->company_name,
                'commercial_company_name'=>$request->commercial_company_name,
                'logo'=> $nama_file,
            ]);
            return redirect(route('partner'))
                ->with(['success' => 'partners <strong>' .$request->name. '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
            // ->with(['error' => 'Terjadi Kesalahan saat Menyimpan data']);
            ->with(['error' => $e->getMessage()]);
        }
    }

    public function show(res_partner $res_partner)
    {
        $country=res_country::orderBy('country_name', 'ASC')->get();
        $state=res_country_state::orderBy('state_name', 'ASC')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        $lang = res_lang::orderBy('lang_name', 'ASC')->get();
        $tz = timezone::orderBy('timezone', 'ASC')->get();
        $industry= res_partner_industry::orderBy('industry_name', 'ASC')->get();
        return view('res_partner.edit_partner',
            compact('res_partner','country','state','currency','lang','tz','industry'));
    }

    public function edit(res_partner $res_partner)
    {
        //
    }

    public function update(Request $request, res_partner $res_partner)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:products',
            'display_name' => 'required|string|max:50',
            'Parent_id' => 'nullable|string|max:100',
            'industry_id' => 'required|integer',
            'address' => 'required|string',
            'email' => 'nullable|string|max:100',
            'street1' => 'nullable|string|max:100',
            'street2' => 'nullable|string|max:100',
            'mobile' => 'nullable|string|max:100',
            'country' => 'required|integer',
            'currency_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);
        try {
            $nama_file="";
            $photo = null;
            if ($request->hasFile('image')) {
                $photo = $request->file('image')->getClientOriginalName();
                $nama_file = time()."_".$photo;
                $destination = base_path() . '/public/uploads/partners';
                $request->file('image')->move($destination, $nama_file);

                $res_partner = res_partner::where('id',$request->id)->update([
                    'partner_name'=> $request->name,
                    'display_name'=> $request->display_name,
                    'title'=> $request->code,
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
                    'address'=> $request->address,
                    'street'=> $request->street1,
                    'zip'=> $request->zip,
                    'city'=> $request->street2,
                    'state_id'=> $request->state,
                    'country_id'=> $request->country,
                    'partner_latitude'=> $request->partner_latitude,
                    'partner_longitude'=> $request->partner_longitude,
                    'email'=> $request->email,
                    'phone'=> $request->phone,
                    'mobile'=> $request->mobile,
                    'industry_id'=> $request->industry_id,
                    'company_name'=>$request->company_name,
                    'commercial_company_name'=>$request->commercial_company_name,
                    'logo'=> $nama_file,
                ]);
                return redirect(route('partner'))
                    ->with(['success' => 'partner <strong>' .$request->name. '</strong> Diubah']);
            }
            else{
                $res_partner = res_partner::where('id',$request->id)->update([
                    'partner_name'=> $request->name,
                    'display_name'=> $request->display_name,
                    'title'=> $request->code,
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
                    'address'=> $request->address,
                    'street'=> $request->street1,
                    'zip'=> $request->zip,
                    'city'=> $request->street2,
                    'state_id'=> $request->state,
                    'country_id'=> $request->country,
                    'partner_latitude'=> $request->partner_latitude,
                    'partner_longitude'=> $request->partner_longitude,
                    'email'=> $request->email,
                    'phone'=> $request->phone,
                    'mobile'=> $request->mobile,
                    'industry_id'=> $request->industry_id,
                    'company_name'=>$request->company_name,
                    'commercial_company_name'=>$request->commercial_company_name,
                ]);
                return redirect(route('partner'))
                    ->with(['success' => 'partner <strong>' .$request->name. '</strong> Diubah']);
            }
        } catch (\Exception $e) {
            return redirect()->back()
            ->with(['error' => 'Terjadi Kesalahan saat Menyimpan data']);
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
