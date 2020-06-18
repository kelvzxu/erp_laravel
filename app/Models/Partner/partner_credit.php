<?php

namespace App\Models\Partner;

use Illuminate\Database\Eloquent\Model;

class partner_credit extends Model
{
    protected $table = 'partner_credit';
    protected $primaryKey = 'purchase_no';
    protected $fillable = [
        'purchase_no','partner_id','purchase_date',
        'due_date','total','updated_at','payment','over',      
        'status','journal'
    ];
}
