<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductionCapacity extends Model
{
    public $table = 'production_capacities';

    public $fillable = [
        'min_production',
        'max_peroduction'
    ];
}
