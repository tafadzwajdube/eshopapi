<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    //
    protected $fillable = [
        'sale_id'
    ];

    public function sale(){
        return $this->belongsTo('App\Sale');
    }
}
