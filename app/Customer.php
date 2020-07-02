<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    protected $attributes = ['status' => 1, 'user_type' => 1, 'profile_pic' => 'default.png', 'student_no' => 0];
    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'position',
        'school',
        'address',
        'phone',
        'email'
    ];

    public function systemstatus(){

        return $this->belongsTo('App\SystemStatus','status','id');

    }

    public function login_info(){
        return $this->belongsTo(User::class, 'login_id', 'id');
    }
}
