<?php

namespace App\Addons\Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class BillProduct extends Model
{
    protected $table = 'purchase_products';
    protected $fillable = [
        'purchase_id','name', 'price', 'qty', 'total'
    ];

    public function purchase()
    {
        return $this->belongsTo(Bill::class);
    }
    public function product()
    {
        return $this->hasOne('App\Addons\Inventory\Models\product','id','name');
    }
}
