<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class res_company extends Model
{
    protected $fillable = [
        'company_name','display_name','currency_id','parent_id','vat','email','Phone', 'website','icon','photo','company_registry','address','street','street2','zip','city','state_id','country_id','partner_latitude','partner_longitude','social_twitter','social_facebook','social_youtube','social_instagram','social_github','social_linkedin','tax_id','bank_account','bank_account2',
    ];
    public function state()
    {
        return $this->hasOne('App\Models\World_database\res_country_state','id','state_id');
    }
    public function country()
    {
        return $this->hasOne('App\Models\World_database\res_country','id','country_id');
    }
    public function currency()
    {
        return $this->hasOne('App\Models\Currency\res_currency','id','currency_id');
    }
    public function parent()
    {
        return $this->hasOne('App\Models\Company\res_company','id','parent_id');
    }
}
