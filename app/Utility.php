<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    protected $hidden = ['id', 'created_at', 'updated_at'];
}
