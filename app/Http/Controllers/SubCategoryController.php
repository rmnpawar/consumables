<?php

namespace App\Http\Controllers;

use App\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::all();
        return response()->json($subcategories, 200);
    }

    public function store(Request $request)
    {
        $subcategory = SubCategory::create($request->all());

        return response()->json($subcategory, 200);
    }

    public function show(SubCategory $subCategory)
    {
        return response()->json($subCategory, 200);
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        $subCategory->update($request->all());

        return response()->json($subCategory, 201);
    }

    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();

        return response()->json(null, 204);
    }
}
