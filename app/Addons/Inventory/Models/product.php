<?php

namespace App\Addons\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Addons\Uom\Models\uom_uom;

class Product extends Model
{
    use softDeletes;
    protected $guarded = [];
    
    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function uom()
    {
        return $this->belongsTo(uom_uom::class,'uom_id');
    }

    public function stock()
    {
        return $this->hasMany(product_quant::class,'product_id');
    }

    public function valuation()
    {
        return $this->hasMany(stock_valuation::class,'product_id');
    }

    public function move()
    {
        return $this->hasMany(stock_move::class,'product_id');
    }
}
