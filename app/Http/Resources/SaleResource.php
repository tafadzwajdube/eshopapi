<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
        "created_by"=>$this->created_by,
        "date"=>$this->date,
        "products"=>$this->productsales,
        "created_at"=>$this->created_at,
        "updated_at"=>$this->updated_at
     ];
    }
}
