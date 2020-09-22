<?php

namespace App\Addons\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class stock_picking_line extends Model
{
    protected $fillable = [
        'stock_picking_id','product_id','description','qty','product_uom','done_qty','order_line_id',
    ];
    
    public function Picking(){
        return $this->belongsTo(stock_picking::class);
    }

    public function product()
    {
        return $this->hasOne(product::class,'id','product_id');
    }
}
