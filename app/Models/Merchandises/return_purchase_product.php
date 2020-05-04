<?php

namespace App\Models\Merchandises;

use Illuminate\Database\Eloquent\Model;

class return_purchase_product extends Model
{
    protected $fillable = [
        'return_id','name','qty','return_qty','price','total'
    ];
    public function invoice()
    {
        return $this->belongsTo(return_purchase::class);
    }
    public function product()
    {
        return $this->hasOne('App\Models\Product\Product','id','name');
    }
}
