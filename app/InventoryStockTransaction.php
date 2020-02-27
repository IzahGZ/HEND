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
        'bom_id'
    ];

    public function transaction_type(){
        return $this->belongsTo(TransactionType::class, 'transaction_id', 'id');
    }

    public function grn(){
        return $this->belongsTo(GoodReceiveNote::class, 'grn_id', 'id');
    }
}
