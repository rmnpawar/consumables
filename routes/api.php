<?php

use App\Category;
use App\Products;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => '/categories'], function() {
    Route::get('/', 'CategoryController@index');
    Route::get('/{category}', 'CategoryController@show');
    Route::get('/{category}/sub_categories', 'CategoryController@sub_categories');
    Route::get('/{category}/products', 'CategoryController@products');
    Route::get('/name/{name}', 'CategoryController@name');
    Route::post('/', 'CategoryController@store');
    Route::put('/{category}', 'CategoryController@update');
    Route::delete('/{category}', 'CategoryController@destroy');
});


Route::group(['prefix' => '/sub_categories'], function() {
    Route::get('/', 'SubCategoryController@index');
    Route::get('/{subCategory}', 'SubCategoryController@show');
    Route::post('/', 'SubCategoryController@store');
    Route::put('/{subCategory}', 'SubCategoryController@update');
    Route::delete('/{subCategory}', 'SubCategoryController@destroy');
});


Route::group(['prefix' => '/products'], function() {
    Route::get('/', 'ProductsController@index');
    Route::get('/{product}', 'ProductsController@show');
    Route::post('/', 'ProductsController@store');
    Route::put('/{product}', 'ProductsController@update');
    Route::delete('/{product}', 'ProductsController@destroy');
});


Route::group(['prefix' => '/brand'], function() {
    Route::get('/', 'BrandController@index');
    Route::get('/{brand}', 'BrandController@show');
    Route::post('/', 'BrandController@store');
    Route::put('/{brand}', 'BrandController@update');
    Route::delete('/{brand}', 'BrandController@destroy');
});

Route::get('/cat/{name}', function($name) {
    $cat = Category::find($name);
    return $cat->sub_categories;
});

Route::get('/product/{product}/add/{subcategory}', function($product, $subcategory) {
    $pd = Products::find($product);
    $sub = SubCategory::find($subcategory);

    $pd->consumables()->attach($subcategory);

    $cons = $pd->consumables;
    

    return response()->json($cons, 200);
});