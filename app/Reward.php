<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{

    protected $hidden = [
        'id','created_at', 'updated_at',
    ];

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function partner()
    {
        return $this->belongsTo('App\Partner','partner_id','custom_id');
    }


}
