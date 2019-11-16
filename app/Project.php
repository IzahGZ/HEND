<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $attributes = ['total_bom' => 0];
    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'supplier',
        'lead_time',
        'price',
        'shelf_life',
        'uom',
        'code',
        'safety_stock',
        'holding_cost'
    ];

    public function products(){

        return $this->belongsTo('App\Project','product_id','id');

    }
}
