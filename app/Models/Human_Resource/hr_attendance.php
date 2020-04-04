<?php

namespace App\Models\Human_Resource;

use Illuminate\Database\Eloquent\Model;

class hr_attendance extends Model
{
    protected $table = 'attendance';
    protected $fillable = ['user_id','date','check_in','check_out'];
}
