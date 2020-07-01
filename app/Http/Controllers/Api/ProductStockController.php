<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductStockResource;
use App\ProductStock;
use Illuminate\Http\Request;

class ProductStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
/*         $request->validate([
            'date'=>"required",
          //  'contact'=>"required"
        ]
        ); */

        $product= new ProductStock;


        $product->stock_id=$request->stock_id;
        $product->product_id=$request->product_id;
        $product->brand_id=$request->brand_id;
        $product->quantity=$request->quantity;
        $product->unit_price=$request->unit_price;
        $product->total_price=$request->total_price;


        if($product->save()){

            //save to productstock

            return new ProductStockResource($product);

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
}
