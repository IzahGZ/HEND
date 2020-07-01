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
        'shelf_life',
        'uom',
        'code',
        'inventory_cost',
        'set_up_cost',
        'category_id'
    ];

    public function raw_material_suppliers() {
        return $this->belongsToMany(Supplier::class, 'raw_material_supplier', 'raw_material_id', 'supplier_id')
            ->withPivot([
                'uom_id',
                'moq_id',
                'price_per_unit',
                'lead_time'
            ])
            ->using(RawMaterialSupplier::class)
            ->withTimestamps();
    }

    public function systemstatus(){

        return $this->belongsTo('App\SystemStatus','status','id');

    }

    public function uoms(){

        return $this->belongsTo('App\Uom','uom','id');

    }

    public function suppliers()
    {
        return $this->hasMany(RawMaterialSupplier::class,'raw_material_id');
    } 
}
