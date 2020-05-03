<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MrpRawMaterial extends Model
{
    public $table = 'mrp_raw_materials';
    protected $attributes = ['quantity' => 0, 
                            'on_hand' => 0, 
                            'schedule_receipt' => 0,
                            'net_requirement' => 0,
                            'order_release' => 0,
                            'order_receipt' => 0,
                            'order_release_status' => 0,
                            'order_receipt_status' => 0];

    public $fillable = [
        'date',
        'raw_material_id',
        'product_id'
    ];
}
