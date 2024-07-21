<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResPartner extends Model
{
    protected $table = 'res_partner';
    
    protected $fillable = [
        'name',
        'display_name',
        'title_id',
        'parent_id',
        'tz_id',
        'currency_id',
        'type',
        'vat',
        'bank_account',
        'website',
        'comment',
        'credit',
        'debit',
        'warning_stage',
        'blocking_stage',
        'active',
        'id_pkp',
        'street',
        'street2',
        'zip',
        'city',
        'state_id',
        'country_id',
        'industry_id',
        'partner_latitude',
        'partner_longitude',
        'email',
        'phone',
        'mobile',
        'additional_info',
        'job_title',
        'image',

    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->display_name = $model->ComputeDisplayName();
        });


    }

    public function ComputeDisplayName()
    {
        if ($this->parent_id) {
            $parent = ResPartner::find($this->parent_id);
            return $parent->name . ', ' . $this->name;
        } else {
            return $this->name;
        }
    }

    
}