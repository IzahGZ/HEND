<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bom extends Model
{
    public $table = 'boms';
    protected $attributes = ['status' => 2];
    public $fillable = [
        'bom_number',
        'project_id',
        'order_id',
        'quantity'
    ];
    public function systemstatus(){

        return $this->belongsTo('App\SystemStatus','status','id');
    }

    public function project(){

        return $this->belongsTo('App\Project','project_id','id');

    }

    public function order(){

        return $this->belongsTo('App\Order','order_id','id');

    }
}
