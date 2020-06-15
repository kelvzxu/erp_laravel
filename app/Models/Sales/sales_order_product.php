<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

class sales_order_product extends Model
{
    protected $fillable = [
        'name', 'price', 'qty', 'total'
    ];

    public function sales()
    {
        return $this->belongsTo(sales_order::class);
    }
    public function product()
    {
        return $this->hasOne('App\Models\Product\Product','id','name');
    }
}
