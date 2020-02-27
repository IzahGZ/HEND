<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    public $fillable = [
        'po_id',
        'pr_id',
        'item_id',
        'quantity',
        'delivery_date',
        'raw_material_supplier_id'
    ];

    public function raw_material(){
        return $this->belongsTo(RawMaterial::class, 'item_id', 'id');
    }

    public function raw_material_supplier(){
        return $this->belongsTo(RawMaterialSupplier::class, 'raw_material_supplier_id', 'id');
    }

    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class, 'po_id', 'id');
    }

    public function system_status(){
        return $this->belongsTo(SystemStatus::class, 'status', 'id');
    }
}
