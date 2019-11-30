<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectProcess extends Pivot
{
    protected $guarded = [];

    public function material() {
        return $this->belongsTo(RawMaterial::class, 'raw_material_id');
    }
}
