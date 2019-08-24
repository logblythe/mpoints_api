<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerSeller extends Model
{
    protected $fillable = [
        'custom_id',
        'partner_id',
        'brn',
        'main_store',
        'seller_name',
        'phone',
        'email',
        'active_inactive'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function partner()
    {
        return $this->belongsTo('App\Partner', 'partner_id', 'custom_id');
    }

    public function employees()
    {
        return $this->hasMany('App\Employee', 'seller_id', 'custom_id');
    }
}
