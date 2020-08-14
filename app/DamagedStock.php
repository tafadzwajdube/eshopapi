<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DamagedStock extends Model
{
    //
    protected $fillable = [
        'created_by'
    ];


    public function damagedproducts(){
        return $this->hasMany('App\DamagedProduct', 'damagedstock_id');
    }
}
