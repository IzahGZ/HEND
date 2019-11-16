<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemStatus extends Model
{
    use SoftDeletes;
    public $table = 'system_statuses';
    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'description',
        'colour'
    ];
}
