<?php

namespace App\Addons\Accounting\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class account_account extends Model
{
    use softDeletes;
    protected $fillable = [
        'name',
        'currency_id',
        'code',
        'deprecated ',
        'type',
        'internal_type',
        'internal_group',
        'reconcile',
        'note',
        'company_id',
        'root_id'
    ];
    public function company()
    {
        return $this->hasOne('App\Models\Company\res_company','id','company_id');
    }
    public function account_type()
    {
        return $this->hasOne(account_account_type::class,'id','type');
    }
    public function move_lines()
    {
        return $this->hasMany(account_move_line::class,'account_id');
    }
}
