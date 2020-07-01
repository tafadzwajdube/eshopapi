<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $fillable = [
        'created_by'
    ];

    public function productstocks(){
        return $this->hasMany('App\ProductStock', 'stock_id');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
