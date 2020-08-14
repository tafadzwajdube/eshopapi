<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

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
        "location"=>$this->location,
        "products"=>$this->productsales,
        "total_groc"=>$this->getTotalGroc($this->productsales),
        "total"=>$this->getTotal($this->productsales,$this->trans_percentage),
        "transport"=>$this->getTrans($this->productsales,$this->trans_percentage),
        "created_at"=>Carbon::parse($this->created_at)->format('d M Y'),
        "updated_at"=>$this->updated_at
     ];
    }

      function getTotalGroc($products){

            $total=0;
            foreach($products as $p){

                $total=$total+$p->cost_rand;
            }

            return $total;
    }

    function getTotal($products, $trans){

        $total=0;
        foreach($products as $p){

            $total=$total+$p->cost_rand;
        }

        $trans_total=$trans*$total;
        return $total+$trans_total;
}

function getTrans($products, $trans){

    $total=0;
    foreach($products as $p){

        $total=$total+$p->cost_rand;
    }

    $trans_total=$trans*$total;
    return $trans_total;
}

}
