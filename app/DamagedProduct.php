<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DamagedProduct extends Model
{
    //
    protected $fillable = [
        'damagedstock_id'
    ];

    public function damagedstock(){
        return $this->belongsTo('App\DamagedStock');
    }
}
