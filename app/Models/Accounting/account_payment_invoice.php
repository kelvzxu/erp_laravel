<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;

class account_payment_invoice extends Model
{
    protected $fillable = [
        'name','payment_reference','move_name','company_id','destination_journal_id','state','payment_type','payment_method_id','partner_type','partner_id','amount','currency_id','payment_date','communication','journal_id','payment_difference_handling','check_amount_in_words','check_number','bank_reference','cheque_reference','effective_date','create_uid',
    ];
    public function company()
    {
        return $this->hasOne('App\Models\Company\res_company','id','company_id');
    }
    public function journal()
    {
        return $this->belongsTo(account_journal::class);
    }
    public function partner()
    {
        return $this->hasOne('App\Models\Customer\res_customer','id','partner_id');
    }
}
