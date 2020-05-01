<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

class delivere_product extends Model
{
    protected $table = 'delivered_products';
    protected $fillable = [
        'validate'
    ];
    public function inv()
    {
        return $this->belongsTo('App\Models\Sales\Invoice','invoice_no','invoice_no');
    }
}
