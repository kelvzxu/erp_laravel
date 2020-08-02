<?php

namespace App\Addons\Uom\Models;

use Illuminate\Database\Eloquent\Model;

class uom_uom extends Model
{
    protected $table = 'uom_uom';
    protected $fillable = [
        'name','category_id','factor','rounding','active','uom_type','measure_type','create_uid',
    ];
    public function category()
    {
        return $this->BelongsTo(uom_category::class,'category_id');
    }
    public function type()
    {
        return $this->BelongsTo(uom_type::class,'uom_type','code');
    }
}
