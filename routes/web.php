<?php

use Illuminate\Support\Facades\Route;
use App\Asset;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get("/", function() {
    $assets = Asset::with('products', 'products.sub_category', 'products.sub_category.category' ,'user', 'section', 'invoice')->get()->map->format();
    return view("welcome", $assets);
});
