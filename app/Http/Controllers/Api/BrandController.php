<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands= Brand::all();
        return BrandResource::collection($brands);

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
            'name'=>"required",
          //  'contact'=>"required"
        ]
        );
        $brand= new Brand;
        $brand->product_id=$request->product_id;
        $brand->name=$request->name;
        $brand->zim_price_rand=$request->zim_price_rand;
        $brand->zim_price_usd=$request->zim_price_usd;
        $brand->sa_price=$request->sa_price;

        if($brand->save()){

            return new BrandResource($brand);

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
        $brand=Brand::findorfail($id);
        return new BrandResource($brand);
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
        $brand=Brand::findorfail($id);
        if($brand->delete()){

            return new BrandResource($brand);
        }
    }
}
