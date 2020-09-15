<?php

namespace App\Addons\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class stock_valuation extends Model
{
    protected $fillable = [
        'company_id','product_id','quantity','unit_cost','value','remaining_qty',
        'remaining_value','description','stock_move_id','account_move_id','create_uid',
    ];
    public function company()
    {
        return $this->hasOne('App\Models\Company\res_company','id','company_id');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
