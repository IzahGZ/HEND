<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $table = 'process';

    public $fillable = [
        'code',
        'name',
        'station',
        'duration'
    ];
}
