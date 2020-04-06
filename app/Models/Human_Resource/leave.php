<?php

namespace App\Models\Human_Resource;;

use Illuminate\Database\Eloquent\Model;

class leave extends Model
{
    protected $fillable = [
        'user_id',
        'leave_type',
        'date_from',
        'date_to',
        'days',
        'reason'
    ];
}
