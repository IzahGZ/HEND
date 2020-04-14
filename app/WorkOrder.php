<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    public $table = 'work_orders';
    public $fillable = [
        'work_order_no',
        'item_id',
        'mrp_id',
        'quantity',
        'due_date',
        'status'
    ];

    public function project(){
        return $this->belongsTo(Project::class, 'item_id', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'item_id', 'id');
    }

    public function system_status(){
        return $this->belongsTo(SystemStatus::class,'status','id');
    }

    public function mrp(){
        return $this->belongsTo(mrp::class,'mrp_id','id');
    }
}
