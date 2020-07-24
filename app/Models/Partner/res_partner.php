<?php

namespace App\Models\Partner;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class res_partner extends Model
{
    use softDeletes;
    protected $table = 'res_partners';
    protected $guarded = [];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function move_lines()
    {
        return $this->hasMany('App\Models\Accounting\account_move_line','partner_id','id')->where('account_internal_type','payable');
    }
    public function currency()
    {
        return $this->hasOne('App\Models\Currency\res_currency','id','currency_id');
    }
}
