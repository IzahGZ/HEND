<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    public $fillable = [
        'name',
        'description'
    ];
}
