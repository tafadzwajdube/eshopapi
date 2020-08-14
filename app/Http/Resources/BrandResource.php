<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
     //   return parent::toArray($request);

     return[

        "id"=>$this->id,
        "product"=>$this->product,
        "name"=>$this->name,
        "quantity"=>$this->quantity,
        "zim_price_rand"=>$this->price_zim_rand,
        "zim_price_usd"=>$this->price_zim_usd,
        "sa_price"=>$this->price_sa,
        "created_at"=>$this->created_at,
        "updated_at"=>$this->updated_at
     ];
    }
}
