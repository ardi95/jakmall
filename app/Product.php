<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'shipping_address','price','shipping_code', 'order_id'
    ];

    public function order()
    {
        return $this->hasOne('App\Order');
    }
}
