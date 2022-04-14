<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::latest()->get();
        return response()->json([
            "status"=>true,
            "data"=>$product,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product =  Product::find($id);
        return response()->json([
            'status'=>true,
            'data'=>$product,
        ],200);
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
        $product = Product::find($id);
    //    return $product;
       $data = $product->update($request->all());
       if($data){
           return response()->json([
            'status'=>true,
            'data'=>$product,
        ],200);
       }else {
        return response()->json([
            'status'=>false,
            'data'=>"Something went wrong ",
        ],200);
       }



    }
/**
     * Search Product
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        // dd($param);
        $product = Product::where('name','like',"%{$name}%")->get();
        // $product = Product::where('name','like','%hello%')->get();
        // dd($product);
        return response()->json([
            'status'=>true,
            'data'=>$product,
        ],200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        // $product->destroy();
        return response()->json([
            'status'=>true,
            'data'=>"Product Deleted Successfully",
        ],200);
    }
}
