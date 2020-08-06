<?php

namespace App\Addons\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class product_warehouse extends Model
{
    protected $fillable = ['name','code','company_id'];
    public function company()
    {
        return $this->hasOne('App\Models\Company\res_company','id','company_id');
    }
}
