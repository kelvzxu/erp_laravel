<?php

namespace App\Addons\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'product_categories';
    protected $fillable = ['name', 'description'];
}
