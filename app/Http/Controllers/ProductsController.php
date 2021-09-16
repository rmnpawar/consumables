<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return response()->json(Products::with('consumables', 'brand', 'sub_category', 'sub_category.category')->get(), 200);
    }


    public function store(Request $request)
    {
        $product = Products::create($request->all());

        return response()->json($product, 201);
    }

    public function show(Products $product)
    {
        return response()->json($product, 200);
    }

    public function update(Request $request, Products $product)
    {
        $product->update($request->all());

        return response()->json($product, 201);

    }

    public function destroy(Products $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }

    public function consumables()
    {
        $consumables = Products::where(function($query) {
            
        })->get();
    }
}
