<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    protected $fillable = [
        'name', 'price', 'qty', 'total'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product','foreign_key');
    }
}
