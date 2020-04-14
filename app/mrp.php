<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class mrp extends Model
{
    public $table = 'mrp';
    protected $attributes = [
        'quantity' => 0,
        'on_hand' => 0,
        'net_requirement' => 0,
        'order_release' => 0,
        'order_receipt' => 0,
        'wo_status' => 0
    ];

    protected $dates = ['date'];

    public $fillable = [
        'date'
    ];

    public function system_status()
    {

        return $this->belongsTo(SystemStatus::class, 'wo_status', 'id');
    }
}
