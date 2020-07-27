<?php

namespace App\Addons\Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class partner_credit extends Model
{
    protected $table = 'partner_credit';
    protected $fillable = [
        'purchase_no','partner_id','purchase_date',
        'due_date','total','updated_at','payment','over',      
        'status','journal'
    ];
}
