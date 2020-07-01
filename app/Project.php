<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

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

    public function products(){

        return $this->belongsTo(Product::class,'product_id');

    }

    public function materials() {
        return $this->belongsToMany(RawMaterial::class, 'project_material', 'project_id', 'raw_material_id')
            ->withPivot([
                'lot_sizing_id',
                'quantity'
            ])
            ->using(ProjectMaterial::class)
            ->withTimestamps();
    }

    public function processes() {
        return $this->belongsToMany(Process::class, 'project_process', 'project_id', 'process_id')
            ->withPivot([
                'duration',
            ])
            ->using(ProjectProcess::class)
            ->withTimestamps();
    }
}
