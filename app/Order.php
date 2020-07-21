<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $attributes = ['status' => 6];
    public $fillable = [
        'order_number',
        'cust_id',
        'order_date',
        'delivery_date'
    ];

    public function order_item()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    } 

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function system_status(){
        return $this->belongsTo(SystemStatus::class, 'status', 'id');
    }
    
}
