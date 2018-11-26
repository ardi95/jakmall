<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number','total','status','user_id', 'type_order'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function prepaid()
    {
        return $this->hasOne('App\Prepaid');
    }

    public function product()
    {
        return $this->hasOne('App\Product');
    }
}
