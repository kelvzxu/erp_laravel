<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    protected $fillable = [
        'name', 'price', 'qty', 'total'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
