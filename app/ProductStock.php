<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    //
    protected $fillable = [
        'stock_id'
    ];

    public function stock(){
        return $this->belongsTo('App\Stock');
    }
}
