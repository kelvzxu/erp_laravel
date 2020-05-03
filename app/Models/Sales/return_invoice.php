<?php

namespace App\Models\Sales;

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
}
