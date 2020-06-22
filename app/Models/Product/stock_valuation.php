<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class stock_valuation extends Model
{
    public function company()
    {
        return $this->hasOne('App\Models\Company\res_company','id','company_id');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
