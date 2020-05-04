<?php

namespace App\Models\Merchandises;

use Illuminate\Database\Eloquent\Model;

class return_purchase extends Model
{
    public function products()
    {
        return $this->hasMany(return_invoice_product::class);
    }
    public function invoice()
    {
        return $this->hasOne(Purchase::class);
    }
    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
}
