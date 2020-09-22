<?php

namespace App\Addons\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company\res_company;

class stock_move extends Model
{
    protected $fillable = [
        'company_id','product_id','quantity','product_uom',
        'location_id','location_destination','location_name',
        'location_destination_name','partner_id','state','type',
        'reference','order_line_id','create_uid',
    ];
    public function valuation()
    {
        return $this->hasOne(stock_valuation::class);
    }

    public function company()
    {
        return $this->hasOne(res_company::class,'id','company_id');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
