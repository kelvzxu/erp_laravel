<?php

namespace App\Models\Partner;

use Illuminate\Database\Eloquent\Model;

class partner_credit extends Model
{
    protected $table = 'partner_credit';
    protected $fillable = [
        'purchase_no','partner_id','purchase_date','status',
        'due_date','total','payment_date','payment','over',      
        'status','journal'
    ];
}
