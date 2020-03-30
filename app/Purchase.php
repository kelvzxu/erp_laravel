<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'purchase_no', 'purchase_date', 'due_date',
        'title', 'sub_total', 'discount',
        'grand_total', 'client',
        'client_address'
    ];

    public function products()
    {
        return $this->hasMany(PurchaseProduct::class);
    }
}
