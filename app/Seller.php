<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = [
        'custom_id',
        'brn',
        'main_store',
        'seller_name',
        'phone',
        'email',
        'active_inactive'
    ];

    public function partner()
    {
        return $this->belongsTo('App\Partner', 'partner_id', 'custom_id');
    }
}
