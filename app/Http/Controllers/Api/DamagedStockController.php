<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use App\DamagedProduct;
use App\DamagedStock;
use App\Http\Controllers\Controller;
use App\Http\Resources\DamagedStockResource;
use Illuminate\Http\Request;

class DamagedStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $damagedstocks= DamagedStock::all();
        return DamagedStockResource::collection($damagedstocks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'products'=>"required"
          //  'contact'=>"required"
        ]
        );

        $damagedstock= new DamagedStock;
        $damagedstock->created_by=auth()->user()->id;
        $damagedstock->date=$request->date;
        $products=$request->products;
        if($damagedstock->save()){
        foreach($products as $p){

            $product= new DamagedProduct;

           $product->damagedstock_id=$damagedstock->id;
            $product->product_id=$p['product_id'];
            $product->brand_id=$p['brand_id'];
            $product->quantity=$p['quantity'];
            $product->unit_price=$p['unit_cost'];
            $product->total_price=$p['total_cost'];


            if($product->save()){

                //save to productstock

           //     return new ProductStockResource($product); add to stock

           $this->subtractStock($product->brand_id, $product->quantity);

            }
        }
        return new DamagedStockResource($damagedstock);
    }
        else

          return(["error"=>"an error occured"]);





    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $stock= DamagedStock::findorfail($id);
        return new DamagedStockResource($stock);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $stock=   DamagedStock::findorfail($id);
        if($stock->delete())
        return new DamagedStockResource($stock);
    }

    public function subtractStock($id,$q){

        $brand=Brand::findorfail($id);
        $quantity=$brand->quantity-$q;
        $brand->quantity=$quantity;
        $brand->save();
    }
}
