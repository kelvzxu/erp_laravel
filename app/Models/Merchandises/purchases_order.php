<?php

namespace App\Models\Merchandises;

use Illuminate\Database\Eloquent\Model;

class purchases_order extends Model
{
    protected $fillable = [
        'order_no', 'order_date','vendor','vendor_reference',
        'taxes', 'sub_total', 'discount',
        'grand_total','receipt','receipt_validate',
        'status','merchandise','invoice','confirm_date'
    ];

    public function products()
    {
        return $this->hasMany(purchases_order_products::class);
    }
    public function partner()
    {
        return $this->hasOne('App\Models\Partner\res_partner','id','vendor');
    }
    public function sales()
    {
        return $this->belongsTo('App\Models\Human_Resource\hr_employee','merchandise','user_id');
    }
}
