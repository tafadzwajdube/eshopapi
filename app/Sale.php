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
        return $this->hasMany('App\ProductSale', 'sale_id');
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($sale) { // before delete() method call this
            $sale->productsales()->each(function($product) {
               $product->delete(); // <-- direct deletion
            });
            // do the rest of the cleanup...
       });
    }
}
