<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'custom_id',
        'business_name',
        'description_html',
        'image',
        'phone',
        'email',
        'website',
        'facebook',
        'mp_rate',
        'sp_rate',
        'active_inactive',
        'category_id'
    ];

    protected $hidden = [
        'id', 'created_at', 'updated_at',
    ];

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }


    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function rewards()
    {
        return $this->hasMany('App\Reward', 'partner_id', 'custom_id');
    }
}
