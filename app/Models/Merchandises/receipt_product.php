<?php

namespace App\Models\Merchandises;

use Illuminate\Database\Eloquent\Model;

class receipt_product extends Model
{
    protected $fillable = [
        'validate'
    ];
    public function po()
    {
        return $this->belongsTo('App\Models\Merchandises\Purchase','purchase_no','purchase_no');
    }
}
