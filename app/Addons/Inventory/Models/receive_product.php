<?php

namespace App\Addons\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class receive_product extends Model
{
    protected $table = 'receipt_products';
    protected $fillable = [
        'validate'
    ];
    public function po()
    {
        return $this->belongsTo('App\Models\Merchandises\Purchase','purchase_no','purchase_no');
    }
}
