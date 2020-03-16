<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mrp extends Model
{
    public $table = 'mrp';
    protected $attributes = ['quantity' => 0, 
                            'on_hand' => 0, 
                            'net_requirement' => 0,
                            'order_release' => 0,
                            'order_receipt' => 0];

    public $fillable = [
        'date'
    ];
}
