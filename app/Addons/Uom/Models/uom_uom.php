<?php

namespace App\Addons\Uom\Models;

use Illuminate\Database\Eloquent\Model;

class uom_uom extends Model
{
    protected $table = 'uom_uom';
    public function category()
    {
        return $this->BelongsTo(uom_category::class,'category_id');
    }
    public function type()
    {
        return $this->BelongsTo(uom_type::class,'uom_type','code');
    }
}
