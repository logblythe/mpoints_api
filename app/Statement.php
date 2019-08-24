<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    protected $fillable = [
        'user_id',
        'partner_id',
        'seller_id',
        'employee_id',
        'transaction_type',
        'purchase_amount',
        'count_of_items',
        'mp_amount',
        'sp_amount',
        'reward_id'
    ];

    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function partner()
    {
        return $this->belongsTo('App\Partner', 'partner_id', 'custom_id');
    }

    public function seller()
    {
        return $this->belongsTo('App\Seller', 'seller_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id', 'id');
    }

    public function transactionType()
    {
        return $this->hasOne('App\TransactionType', 'id', 'transaction_type');
    }


    public function reward()
    {
        return $this->belongsTo('App\Reward', 'reward_id', 'custom_id');
    }
}
