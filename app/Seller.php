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

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function partners()
    {
        return $this->belongsToMany('App\Partner');
    }

    public function employees()
    {
        return $this->hasMany('App\Employee', 'seller_id', 'custom_id');
    }
}
