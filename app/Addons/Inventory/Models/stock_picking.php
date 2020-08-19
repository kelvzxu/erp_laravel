<?php

namespace App\Addons\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use App\Addons\Sales\Models\sales_order;
use App\Addons\Purchase\Models\purchases_order;
use App\Models\Human_Resource\hr_employee;
use App\Models\Company\res_company;

class stock_picking extends Model
{
    protected $fillable = [
        'id','name','origin','backorder_id','move_type','state','schedule_date','date_done','location_id','destination_id','picking_type','partner_id','company_id','is_locked','order_id','create_uid'
    ];

    public function picking_line()
    {
        return $this->hasMany(stock_picking_line::class);
    }

    public function sales_order()
    {
        return $this->BelongsTo(sales_order::class,'order_id');
    }

    public function purchases_order()
    {
        return $this->BelongsTo(purchases_order::class,'order_id');
    }

    public function sales_warehouse()
    {
        return $this->BelongsTo(product_warehouse::class,'location_id');
    }

    public function purchases_warehouse()
    {
        return $this->BelongsTo(product_warehouse::class,'destination_id');
    }

    public function company()
    {
        return $this->hasOne(res_company::class,'id','company_id');
    }

    public function responsible()
    {
        return $this->belongsTo(hr_employee::class,'create_uid','user_id');
    }
}
