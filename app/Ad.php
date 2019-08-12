<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'uid', 'campaign_name', 'image', 'url', 'start_date', 'end_date', 'active_inactive',
    ];

    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];
}
