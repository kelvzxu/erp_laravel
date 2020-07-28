<?php

namespace App\Addons\Accounting\Models;

use Illuminate\Database\Eloquent\Model;

class account_move_line extends Model
{
    protected $fillable = [
        'account_move_id','account_move_name','date','ref','parent_state',
        'journal_id','company_id','company_currency_id','account_id',
        'account_internal_type','product_id','name','quantity','price_unit',
        'price_total','debit','credit','balance','reconciled','currency_id',
        'partner_id','create_uid','payment_id',
    ];
    public function account_move()
    {
        return $this->belongsTo(account_move::class);
    }
    public function company()
    {
        return $this->hasOne('App\Models\Company\res_company','id','company_id');
    }
    public function account()
    {
        return $this->BelongsTo(account_account::class);
    }
}
