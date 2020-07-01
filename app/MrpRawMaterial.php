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
                            'pr_id' => 0,
                            'order_receipt_status' => 0];

    public $fillable = [
        'date',
        'raw_material_id',
        'product_id'
    ];

    public function orderRelease_status()
    {
        return $this->belongsTo(SystemStatus::class, 'order_release_status', 'id');
    }

    public function orderReceipt_status()
    {
        return $this->belongsTo(SystemStatus::class, 'order_receipt_status', 'id');
    }

    public function rawMaterials()
    {
        return $this->belongsTo(RawMaterial::class, 'raw_material_id', 'id');
    }

    public function purchaseRequests()
    {
        return $this->belongsTo(RequestOfPurchase::class, 'pr_id', 'id');
    }
}
