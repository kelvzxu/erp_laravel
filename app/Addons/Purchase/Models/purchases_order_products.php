<?php

namespace App\Addons\Purchase\Models;

use Illuminate\Database\Eloquent\Model;
use App\Addons\Uom\Models\uom_uom;

class purchases_order_products extends Model
{
    protected $fillable = [
        'purchases_order_id','name','description','product_uom','product_uom_qty','product_uom_category','qty','price','price_subtotal','taxes','price_tax','total',
    ];

    public function purchase()
    {
        return $this->belongsTo(purchases_order::class);
    }
    public function product()
    {
        return $this->hasOne('App\Models\Product\Product','id','name');
    }
    public function uom()
    {
        return $this->belongsTo(uom_uom::class,'product_uom');
    }
}
