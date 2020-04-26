<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $dates = ['created_at'];
    
    public function order_detail()
    {
        return $this->hasMany(Order_detail::class);
    }

    public function customer()
    {
        return $this->hasOne('App\Models\Customer\res_customer','id','customer_id');
    }

    public function sales()
    {
        return $this->hasOne('App\User','id','user_id');
    }
}
