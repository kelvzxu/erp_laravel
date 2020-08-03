<?php

namespace App\Addons\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class delivere_product extends Model
{
    protected $table = 'delivered_products';
    protected $fillable = [
        'validate'
    ];
    public function inv()
    {
        return $this->belongsTo(' App\Addons\Invoicing\Models\Invoice','invoice_no','invoice_no');
    }
}
