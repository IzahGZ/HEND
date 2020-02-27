<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterialSupplier extends Model
{
    use SoftDeletes;
    public $table = 'raw_material_supplier';
    protected $dates = ['deleted_at'];

    public $fillable = [
        'raw_material_id',
        'supplier_id',
        'uom_id',
        'moq_id',
        'price_per_unit',
        'lead_time'
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function uom(){
        return $this->belongsTo(Uom::class, 'uom_id', 'id');
    }

    public function moq(){
        return $this->belongsTo(Moq::class, 'moq_id', 'id');
    }
}
