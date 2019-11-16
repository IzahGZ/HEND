<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterial extends Model
{
    use SoftDeletes;
    protected $attributes = ['status' => 1, 'current_stock' => 0];
    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'supplier',
        'lead_time',
        'price',
        'shelf_life',
        'uom',
        'code',
        'safety_stock',
        'holding_cost'
    ];

    public function systemstatus(){

        return $this->belongsTo('App\SystemStatus','status','id');

    }

    public function uoms(){

        return $this->belongsTo('App\Uom','uom','id');

    }

    public function suppliers(){

        return $this->belongsTo('App\Supplier','supplier','id');

    }
}
