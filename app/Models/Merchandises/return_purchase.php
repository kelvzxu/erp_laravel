<?php

namespace App\Models\Merchandises;

use Illuminate\Database\Eloquent\Model;

class return_purchase extends Model
{
    public function products()
    {
        return $this->hasMany(return_purchase_product::class);
    }
    public function invoice()
    {
        return $this->hasOne(Purchase::class);
    }
    public function user()
    {
        return $this->belongsTo('App\Models\Human_Resource\hr_employee','user_id','user_id');
    }
    public function partner()
    {
        return $this->hasOne('App\Models\Partner\res_partner','id','client');
    }
}
