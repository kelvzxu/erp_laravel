<?php

namespace App\Models\Merchandises;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    protected $fillable = [
        'name', 'price', 'qty', 'total'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function product()
    {
        return $this->hasOne('App\Models\Product\Product','id','name');
    }
}
