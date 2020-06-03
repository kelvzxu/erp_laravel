<?php

namespace App\Models\Merchandises;

use Illuminate\Database\Eloquent\Model;

class purchases_order_products extends Model
{
    protected $fillable = [
        'name', 'price', 'qty', 'total'
    ];

    public function purchase()
    {
        return $this->belongsTo(purchases_order::class);
    }
    public function product()
    {
        return $this->hasOne('App\Models\Product\Product','id','name');
    }
}
