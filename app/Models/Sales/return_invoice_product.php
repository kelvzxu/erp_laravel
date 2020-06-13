<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

class return_invoice_product extends Model
{
    protected $fillable = [
        'return_invoice_id','name','qty','return_qty','price','total'
    ];
    public function invoice()
    {
        return $this->belongsTo(return_Invoice::class);
    }
    public function product()
    {
        return $this->hasOne('App\Models\Product\Product','id','name');
    }
}
