<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class res_customer extends Model
{
    use softDeletes;
    protected $table = 'res_customers';
    protected $fillable = [
        'name',
        'display_name',
        'parent_id',
        'ref',
        'lag',
        'tz',
        'currency_id',
        'bank_account',
        'website',
        'credit_limit',
        'debit_limit',
        'active',
        'address',
        'street',
        'street2',
        'zip',
        'city',
        'state_id',
        'country_id',
        'email',
        'phone',
        'mobile',
        'industry_id',
        'sales',
        'payment_terms',
        'note',
        'user_id',
        'receivable_account',
        'logo'
    ];
    public function state()
    {
        return $this->hasOne('App\Models\World_database\res_country_state','id','state_id');
    }
}
