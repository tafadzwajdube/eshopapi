<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class DamagedStockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
       return[

        "id"=>$this->id,
        "created_by"=>$this->created_by,
        "user_name"=>$this->findUser($this->created_by),
        "date"=>$this->date,
        "products"=>$this->damagedproducts,
        "total"=>$this->getTotal($this->damagedproducts),
        "created_at"=>Carbon::parse($this->created_at)->format('d M Y'),
        "updated_at"=>$this->updated_at
     ];
    }

    function getTotal($products){

        $total=0;
        foreach($products as $p){

            $total=$total+$p->total_price;
        }

        return $total;
}

function findUser($id){

    $user=User::findorfail($id);

    $name=$user->name;
    $arr = explode(' ',trim($name));
   return $arr[0];
}
}
