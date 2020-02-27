<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodReceiveNote extends Model
{
    public $fillable = [
        'grn_number',
        'po_id',
        'supplier_do_number',
        'supplier_do_date',
        'receiving_area',
        'receive_by'

    ];

    public function purchaseorder()
    {
        return $this->belongsTo(PurchaseOrder::class,'po_id', 'id');
    } 

    public function goodReceiveNoteItem()
    {
        return $this->hasMany(GoodReceiveNoteItem::class,'grn_id');
    }
}
