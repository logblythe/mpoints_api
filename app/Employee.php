<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'custom_id', 'seller_id', 'first_name', 'last_name', 'pin', 'active_inactive'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function seller()
    {
        return $this->belongsTo('App\Seller', 'seller_id', 'custom_id');
    }

    public function partnerSeller()
    {
        return $this->belongsTo('App\PartnerSeller', 'seller_id', 'custom_id');
    }
}
