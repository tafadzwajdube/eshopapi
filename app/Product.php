<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //real product as brands

    public function brands(){
        return $this->hasMany('App\Brand', 'product_id');
    }
}
