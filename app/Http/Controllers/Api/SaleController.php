<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductSaleResource;
use App\Http\Resources\SaleResource;
use App\ProductSale;
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
        return SaleResource::collection($sales);
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
        $sale->location=$this->findLocation();//"my location";//$request->location;
        $sale->trans_percentage=$request->trans_percentage;

        $products=$request->products;


        if($sale->save()){
        foreach($products as $product){
            $productSale= new ProductSale;
            $productSale->sale_id=$sale->id;
            $productSale->product_id=$product['product_id'];
            $productSale->brand_id=$product['brand_id'];
            $productSale->unit_cost_rand=$product['unit_cost_rand'];
           // $productSale->unit_cost_usd=$product['unit_cost_usd'];
            $productSale->quantity=$product['quantity'];
            $productSale->cost_rand=$product['total_cost_rand'];
            //$productSale->total_cost_usd=$product-['total_cost_usd'];
            $productSale->exchange_rate=0.0;
            if($productSale->save()){
                $this->subtractStock($productSale->brand_id, $product['quantity']);
            };

        }
        return new SaleResource($sale);

    }
        else
        return(["error"=>"an error occured here"]);

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
        $sale=Sale::findorfail($id);
        return new SaleResource($sale);
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
        $sale=Sale::findorfail($id);
        $products=$sale->productsales;

   //return new ProductSaleResource($products);

        foreach($products as $p){

            $brand=Brand::findorfail($p->brand_id);
            $brand->quantity=$brand->quantity+$p->quantity;
            $brand->save();
        }

        //return [$brand];

      //  $sale->delete();

          if($sale->delete()){

            return new SaleResource($sale);
        }
    }

    public function subtractStock($id,$q){

        $brand=Brand::findorfail($id);
        $quantity=$brand->quantity-$q;
        $brand->quantity=$quantity;
        $brand->save();
    }

    public function findLocation(){
        $user=auth()->user()->id;
        if($user==6)
            return "SA";
            else if($user==4)
            return "Zim-US";
            else
            return "Zim";

    }
}
