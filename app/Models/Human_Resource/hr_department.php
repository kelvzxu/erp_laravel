<?php

namespace App\Models\Human_Resource;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hr_department extends Model
{
    use softDeletes;
    public function manager()
    {
        return $this->hasOne('App\Models\Human_Resource\hr_employee','id','manager_id');
    }
}
