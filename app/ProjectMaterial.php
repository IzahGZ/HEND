<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectMaterial extends Pivot
{
    protected $guarded = [];

    public function raw_material(){

        return $this->belongsTo('App\RawMaterial','raw_material_id','id');

    }
    public function lot_sizing(){
        return $this->belongsTo(LotSizing::class, 'lot_sizing_id');
    }
}
