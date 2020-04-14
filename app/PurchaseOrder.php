<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    // public $table = 'request_of_purchase';
    protected $attributes = ['status' => 2];
    public $fillable = [
        'po_number',
        'po_date',
        'delivery_address',
        'supplier_id',
        'purchase_by'
    ];

    public function purchase_order_items(){
        return $this->hasMany(PurchaseOrderItem::class, 'po_id');
    }

    public function suppliers(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    
    public function system_status(){
        return $this->belongsTo(SystemStatus::class, 'status', 'id');
    }

}
