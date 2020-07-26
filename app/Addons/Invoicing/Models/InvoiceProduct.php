<?php

namespace App\Addons\Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    protected $fillable = [
        'invoice_id','name', 'price', 'qty', 'total'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function product()
    {
        return $this->hasOne('App\Models\Product\Product','id','name');
    }
}
