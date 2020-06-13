<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class stock_move extends Model
{
    public function valuation()
    {
        return $this->hasOne(stock_valuation::class);
    }
}
