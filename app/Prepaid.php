<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prepaid extends Model
{
    protected $fillable = [
        'no_hp', 'valuepaid', 'order_id'
    ];

    public function order()
    {
        return $this->hasOne('App\Order');
    }
}
