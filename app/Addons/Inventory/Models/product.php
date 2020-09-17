<?php

namespace App\Addons\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Addons\Uom\Models\uom_uom;

class Product extends Model
{
    use softDeletes;
    protected $fillable = [
        'name','code','barcode','description','type','category_id','company_id','price','cost','tax_id','volume','weight','quantity','can_be_sold','can_be_purchase','uom_id','uom_po_id','uom_category','photo','create_uid',
    ];

    public function quantity()
    {
        return $this->hasMany(product_quant::class);
    }
    
    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function uom()
    {
        return $this->belongsTo(uom_uom::class,'uom_id');
    }

    public function uom_po()
    {
        return $this->belongsTo(uom_uom::class,'uom_po_id');
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
