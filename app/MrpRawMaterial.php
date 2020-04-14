<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MrpRawMaterial extends Model
{
    public $table = 'mrp_raw_material';
    protected $attributes = ['quantity' => 0, 
                            'on_hand' => 0, 
                            'net_requirement' => 0,
                            'order_release' => 0,
                            'order_receipt' => 0];

    public $fillable = [
        'date',
        'raw_material_id',
        'mrp_id'
    ];

    public function raw_material(){
        return $this->belongsTo(mrp::class, 'mrp_id', 'id');
    }
}
