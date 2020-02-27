<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $table = 'order_items';

    public $fillable = [
        'order_id',
        'item_id',
        'quantity'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'item_id', 'id');
    }
}
