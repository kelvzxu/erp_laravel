<?php

namespace App\Addons\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class product_quant extends Model
{
    protected $fillable = [
        'product_id','company_id','location_id','lot_id','package_id','owner_id',
        'quantity','reserved_quantity','minimum_quantity','create_uid',
    ];
}
