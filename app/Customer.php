<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    protected $attributes = ['status' => 1];
    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'address',
        'phone',
        'email'
    ];
    
    public function systemstatus(){

        return $this->belongsTo('App\SystemStatus','status','id');

    }
}
