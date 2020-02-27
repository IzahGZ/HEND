<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodReceiveNoteItem extends Model
{
    public $fillable = [
        'grn_id',
        'po_item_id',
        'order_quantity',
        'receive_quantity'
    ];

    public function purchaseOrderItem()
    {
        return $this->belongsTo(PurchaseOrderItem::class,'po_item_id', 'id');
    } 
}
