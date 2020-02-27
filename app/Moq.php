<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Moq extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $table = 'moq';

    public $fillable = [
        'name',
        'description',
        'min_quantity',
        'max_quantity'
    ];
}
