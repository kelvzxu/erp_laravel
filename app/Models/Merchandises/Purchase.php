<?php

namespace App\Models\Merchandises;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'purchase_no', 'purchase_date', 'due_date',
        'title', 'sub_total', 'discount',
        'grand_total', 'client','receipt','receipt_validate',
        'client_address','approved','status','merchandise','paid',
    ];

    public function products()
    {
        return $this->hasMany(PurchaseProduct::class);
    }
    public function vendor()
    {
        return $this->hasOne('App\Models\Partner\res_partner','id','client');
    }
}
