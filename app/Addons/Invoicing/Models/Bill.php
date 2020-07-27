<?php

namespace App\Addons\Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'purchases';
    protected $fillable = [
        'purchase_no', 'purchase_date', 'due_date',
        'title', 'sub_total', 'discount',
        'grand_total', 'client','receipt','receipt_validate',
        'client_address','approved','status','merchandise','paid',
    ];

    public function products()
    {
        return $this->hasMany(BillProduct::class,'purchase_id');
    }
    public function vendor()
    {
        return $this->hasOne('App\Addons\Contact\Models\res_partner','id','client');
    }
}
