<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryStockTransaction extends Model
{
    public $fillable = [
        'transaction_id',
        'transaction_by',
        'quantity',
        'grn_id',
        'wo_id',
        'category_id',
        'item_id'
    ];

    public function transaction_type(){
        return $this->belongsTo(TransactionType::class, 'transaction_id', 'id');
    }

    public function inventory_category(){
        return $this->belongsTo(InventoryCategory::class, 'category_id', 'id');
    }

    public function grn(){
        return $this->belongsTo(GoodReceiveNote::class, 'grn_id', 'id');
    }

    public function wo(){
        return $this->belongsTo(WorkOrder::class, 'wo_id', 'id');
    }

    public function po_item(){
        return $this->belongsTo(PurchaseOrderItem::class, 'item_id', 'id');
    }

    public function raw_material_wo(){
        return $this->belongsTo(RawMaterial::class, 'item_id', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'item_id', 'id');
    }
}
