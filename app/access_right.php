<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class access_right extends Model
{
    protected $fillable = [
        'user_id', 'sales', 'purchase','inventory','accounting','point_of_sale',
        'human_resource','administration'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function employee()
    {
        return $this->hasOne('App\Models\Human_Resource\hr_employee','user_id','user_id');
    }
}
