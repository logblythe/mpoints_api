<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'tag_name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function partners()
    {
        return $this->belongsToMany('App\Partner');
    }
}
