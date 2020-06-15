<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

class sales_order extends Model
{
    protected $fillable = [
        'order_no', 'order_date','customer','customer_reference',
        'taxes', 'sub_total', 'discount','expiration',
        'grand_total','receipt','receipt_validate',
        'status','sales','invoice','confirm_date'
    ];

    public function products()
    {
        return $this->hasMany(sales_order_product::class);
    }
    public function partner()
    {
        return $this->hasOne('App\Models\Customer\res_customer','id','customer');
    }
    public function sales_person()
    {
        return $this->belongsTo('App\Models\Human_Resource\hr_employee','sales','user_id');
    }
}
