<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestOfPurchase extends Model
{
    public $table = 'request_of_purchase';
    protected $attributes = ['status' => 6];
    public $fillable = [
        'pr_number',
        'order_id',
        'raw_material_supplier_id',
        'request_by',
        'estimated_date',
        'request_date',
        'quantity',
        'item_id'
    ];

    public function raw_material_supplier(){
        return $this->belongsTo(RawMaterialSupplier::class, 'raw_material_supplier_id', 'id');
    }

    public function raw_material(){
        return $this->belongsTo(RawMaterial::class, 'item_id', 'id');
    }

    public function system_status(){
        return $this->belongsTo(SystemStatus::class, 'status', 'id');
    }
}
