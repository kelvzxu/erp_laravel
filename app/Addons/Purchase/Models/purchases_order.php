<?php

namespace App\Addons\Purchase\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company\res_company;
use App\Addons\Contact\Models\res_partner;

class purchases_order extends Model
{
    protected $fillable = [
        'order_no','order_date','confirm_date','expiration','vendor','vendor_reference','sub_total',
        'discount','taxes','grand_total','invoice','state','picking','picking_validate','product_warehouse_id',
        'company_id','note','is_locked','shipping_policy','merchandise',
    ];

    public function company()
    {
        return $this->hasOne(res_company::class,'id','company_id');
    }
    public function products()
    {
        return $this->hasMany(purchases_order_products::class);
    }
    public function partner()
    {
        return $this->hasOne(res_partner::class,'id','vendor');
    }
    public function merchandises()
    {
        return $this->belongsTo('App\Models\Human_Resource\hr_employee','merchandise','user_id');
    }
}
