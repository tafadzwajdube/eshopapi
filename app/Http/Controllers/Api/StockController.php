<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductStockResource;
use App\Http\Resources\StockResource;
use App\ProductStock;
use App\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stocks= Stock::all();
        return StockResource::collection($stocks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ///*  */
      $request->validate([
            'date'=>"required",
            'products'=>"required"
          //  'contact'=>"required"
        ]
        );

        $stock= new Stock;
        $stock->created_by=auth()->user()->id;
        $stock->date=$request->date;
        $products=$request->products;

        foreach($products as $product){

            $product= new ProductStock;

          //  $product->stock_id=$product->stock_id;
            $product->product_id=$product->id;
            $product->brand_id=$product->brand_id;
            $product->quantity=$product->quantity;
            $product->unit_price=$product->unit_price;
            $product->total_price=$product->total_price;


            if($product->save()){

                //save to productstock

           //     return new ProductStockResource($product); add to stock

           $this->addStock($product->id, $product->quantity);

            }
        }

        if($stock->save()){

            //save to productstock

            return new StockResource($stock);

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
        $stock= Stock::findorfail($id);
        return new StockResource($stock);
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
        $stock= Stock::findorfail($id);
        if($stock->delete())
        return new StockResource($stock);
    }

    public function addStock($id,$q){

        $brand=Brand::findorfail($id);
        $quantity=$brand->quantity+$q;
        $brand->quantity=$quantity;
        $brand->save();
    }
}
