<?php

namespace App\Addons\Sales\Models;

use Illuminate\Database\Eloquent\Model;
use App\Addons\Inventory\Models\stock_picking;

class sales_order extends Model
{
    protected $fillable = [
        'order_no','order_date','confirm_date','expiration','customer','customer_reference','sub_total','discount',
        'taxes','grand_total','invoice','state','picking','picking_validate','sales','product_warehouse_id',
        'company_id','note','shipping_policy',
    ];
    public function company()
    {
        return $this->hasOne('App\Models\Company\res_company','id','company_id');
    }
    public function products()
    {
        return $this->hasMany(sales_order_product::class);
    }
    public function partner()
    {
        return $this->hasOne('App\Addons\Contact\Models\res_customer','id','customer');
    }
    public function sales_person()
    {
        return $this->belongsTo('App\Models\Human_Resource\hr_employee','sales','user_id');
    }
    public function picking()
    {
        return $this->BelongsTo(stock_picking::class);
    }
}
