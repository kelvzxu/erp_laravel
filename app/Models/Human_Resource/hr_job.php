<?php

namespace App\Models\Human_Resource;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hr_job extends Model
{
    use softDeletes;
    public function department()
    {
        return $this->hasOne('App\Models\Human_Resource\hr_department','id','department_id');
    }
}
