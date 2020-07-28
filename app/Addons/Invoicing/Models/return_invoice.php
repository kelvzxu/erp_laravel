<?php

namespace App\Addons\Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class return_invoice extends Model
{
    public function products()
    {
        return $this->hasMany(return_invoice_product::class);
    }
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
    public function user()
    {
        return $this->belongsTo('App\Models\Human_Resource\hr_employee','user_id','user_id');
    }
    public function customer()
    {
        return $this->hasOne('App\Addons\Inventory\Models\res_customer','id','client');
    }
}
