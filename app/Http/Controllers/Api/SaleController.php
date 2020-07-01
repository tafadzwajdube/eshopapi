<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Resources\SaleResource;
use App\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sales=Sale::all();
        return Sale::collection($sales);
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
            'products'=>"required",

          //  'contact'=>"required"
        ]
        );

        $sale=new Sale;
        $sale->created_by=auth()->user()->id;
        $sale->date=$request->date;
        $sale->location=$request->location;

        $products=$request->products;

        foreach($products as $product){

            $product->product_id=$product->product_id;
            $product->brand_id=$product->brand_id;
            $product->unit_cost_rand=$product->unit_cost_rand;
            $product->unit_cost_usd=$product->unit_cost_usd;
            $product->quantity=$product->quantity;
            $product->total_cost_rand=$product->total_cost_rand;
            $product->total_cost_usd=$product->total_cost_usd;
            $product->exchange_rate=0.0;
            if($product->save()){
                $this->subtractStock($product->brand_id, $product->quantity);
            };

        }

        if($sale->save){
            //into the product sales
            return new SaleResource($sale);

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
    }

    public function subtractStock($id,$q){

        $brand=Brand::findorfail($id);
        $quantity=$brand->quantity-$q;
        $brand->quantity=$quantity;
        $brand->save();
    }
}
