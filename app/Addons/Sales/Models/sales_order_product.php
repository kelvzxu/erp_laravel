<?php

namespace App\Addons\Sales\Models;

use Illuminate\Database\Eloquent\Model;
use App\Addons\Uom\Models\uom_uom;

class sales_order_product extends Model
{
    protected $fillable = [
        'sales_order_id','name','description','product_uom','product_uom_qty','product_uom_category','qty','price','price_subtotal','taxes','price_tax','total',
    ];

    public function sales()
    {
        return $this->belongsTo(sales_order::class);
    }
    public function product()
    {
        return $this->hasOne('App\Addons\Inventory\Models\product','id','name');
    }
    public function uom()
    {
        return $this->belongsTo(uom_uom::class,'product_uom');
    }
}
