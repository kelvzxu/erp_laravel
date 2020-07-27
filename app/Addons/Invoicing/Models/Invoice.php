<?php

namespace App\Addons\Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_no', 'invoice_date', 'due_date',
        'title', 'sub_total', 'discount','deliver_validate',
        'grand_total', 'client','deliver','paid',
        'client_address','approved','status','sales'
    ];

    public function products()
    {
        return $this->hasMany(InvoiceProduct::class);
    }
    public function partner()
    {
        return $this->hasOne('App\Addons\Contact\Models\res_customer','id','client');
    }
    public function payment()
    {
        return $this->hasOne(customer_dept::class,'invoice_no','invoice_no');
    }
    public function sales()
    {
        return $this->belongsTo('App\Models\Human_Resource\hr_employee','id','user_id');
    }
}
