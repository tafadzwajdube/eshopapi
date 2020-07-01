<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //

    protected $fillable = [
        'created_by'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function productsales(){
        return $this->hasMany('App\ProductSales', 'sale_id');
    }
}
