<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return response()->json(Brand::all(), 200);
    }

    public function store(Request $request)
    {
        $brand = Brand::create($request->all());

        return response()->json($brand, 200);
    }

    public function show(Brand $brand)
    {
        return response()->json($brand, 200);
    }

    public function update(Request $request, Brand $brand)
    {
        $brand->update($request->all());

        return response()->json($brand, 201);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->json(null, 204);
    }
}
