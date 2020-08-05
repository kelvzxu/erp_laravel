<?php

namespace App\Addons\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'product_categories';
    protected $fillable = ['name','complete_name','parent_id','description','removal_strategy_id','costing_method','create_uid',];
}
