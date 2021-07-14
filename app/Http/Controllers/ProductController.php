<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    function post(Request $request)
    {
        $product = new Product;
        $product->Title = $request->Title;
        $product->Product_URL = $request->Product_URL;
        $product->State = $request->State;
        $product->Seller_Name = $request->Seller_Name;
        $product->Price = $request->Price;
        $product->save();
        return new ProductResource($product);
    }

    function get()
    {
        $product =  Product::all();

        // return response()->json(
        //     [
        //         "message" => "Success",
        //         "data" => $product
        //     ]
        // );

        return ProductResource::collection($product);
    }
    function getById($id)
    {
        $product =  Product::find($id);
        if (!$product) {
            return response()->json(
                [
                    "message" => "Not Found"
                ],
                400
            );
        }
        return new ProductResource($product);
    }
    function put($id, Request $request)
    {
        $product =  Product::find($id);


        if ($product) {

            $product->Title = $request->Title;
            $product->Product_URL = $request->Product_URL;
            $product->State = $request->State;
            $product->Seller_Name = $request->Seller_Name;
            $product->Price = $request->Price;
            $product->save();
            return new ProductResource($product);
        }

        return response()->json(
            [
                "message" => "Not Found"
            ],
            400
        );
    }
    function delete($id)
    {
        $product =  Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(
                [
                    "message" => "Success"
                ]
            );
        }

        return response()->json(
            [
                "message" => "Not Found"
            ],
            400
        );
    }
}