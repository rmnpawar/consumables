<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        return response()->json($category, 200);
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return response()->json($category, 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 210);
    }

    public function name($name)
    {
        $category = Category::where('cat_name', $name)->first();
        return response()->json($category, 200);
    }

    public function sub_categories(Category $category)
    {
        return response()->json($category->sub_categories, 200);
    }

    public function products(Category $category)
    {
        return response()->json($category->products, 200);
    }
}
