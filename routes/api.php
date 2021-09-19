<?php

use App\Asset;
use App\Category;
use App\Products;
use App\SubCategory;
use App\User;
use App\Section;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => '/categories'], function() {
    Route::get('/', 'CategoryController@index');
    Route::get('/allconsumables', 'CategoryController@allConsumables');
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
    Route::get('/{subCategory}/products', 'SubCategoryController@products');
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

    Route::get('/consumables', 'ProductsController@consumables');
});


Route::group(['prefix' => '/brands'], function() {
    Route::get('/', 'BrandController@index');
    Route::get('/{brand}', 'BrandController@show');
    Route::post('/', 'BrandController@store');
    Route::put('/{brand}', 'BrandController@update');
    Route::delete('/{brand}', 'BrandController@destroy');
});


Route::group(['prefix' => '/sections'], function() {
    Route::get('/', 'SectionController@index');
    Route::get('/{section}', 'SectionController@show');
    Route::post('/', 'SectionController@store');
    Route::put('/{section}', 'SectionController@update');
    Route::delete('/{section}', 'SectionController@destroy');
});


Route::group(['prefix' => '/user'], function() {
    Route::get('/', 'Auth\LoginController@user');
    Route::get('/logout', 'Auth\LoginController@logOut');
    Route::get('/list', 'UserController@sectionList');
    Route::post('/login', 'Auth\LoginController@login');
    Route::post('/register', 'Auth\RegisterController@register');
    Route::post('/{user}/assignroles', 'UserController@assignRoles');
});


Route::group(['prefix' => '/role'], function() {
    Route::get('/', 'RoleController@index');
    Route::get('/{route}', 'RoleController@show');
    Route::post('/', 'RoleController@store');
    Route::post('/{role}/givepermission', 'RoleController@givePermission');
    Route::put('/{route}', 'RoleController@update');
    Route::delete('/{route}', 'RoleController@destroy');
});


Route::group(['prefix' => '/permission'], function() {
    Route::get('/', 'PermissionController@index');
    Route::get('/{permission}', 'PermissionController@show');
    Route::post('/', 'PermissionController@store');
    Route::put('/{permission}', 'PermissionController@update');
    Route::delete('/{permission}', 'PermissionController@destroy');
});


Route::group(['prefix' => '/consumables'], function() {
    Route::get('/', 'ConsumableController@index');
    Route::post('/', 'ConsumableController@store');
});


Route::group(['prefix' => '/suppliers'], function () {
    Route::get('/', 'SupplierController@index');
    Route::get('/{supplier}', 'SupplierController@show');
    Route::post('/', 'SupplierController@store');
    Route::put('/{supplier}', 'SupplierController@update');
    Route::delete('/{supplier}', 'SupplierController@delete');
});


Route::group(['prefix' => '/invoices'], function() {
    Route::get('/', 'InvoiceController@index');
    Route::get('/{invoice}', 'InvoiceController@show');
    Route::post('/', 'InvoiceController@store');
    Route::post('/{item}/receive', 'InvoiceItemController@receiveItem');
    Route::post('/{invoice}/items', 'InvoiceController@addItems');
    Route::delete('/{invoice}', 'InvoiceController@delete');
});


Route::group(['prefix' => '/assets'], function() {
    Route::get('/', 'AssetController@index');
    Route::get('/in_category/{id}', 'AssetController@assetInCategory');
    Route::post('/issue_against_request', 'AssetController@issueAgainstRequest');
    Route::get('/list', 'AssetController@assetList');
});


<<<<<<< HEAD
Route::group(['prefix' => '/requests'], function() {
    Route::get('/', 'RequestController@createdRequests');
    Route::post('/', 'RequestController@store');
});


Route::get('/test', function() {
    return Asset::test();
=======
Route::get('/start', function() {
    $section = Section::create([
        "section_name" => "D&RAC"
    ]);


    $user = User::create([
        "name" => "Administrator",
        "email" => "saorda.def@cag.gov.in",
        "section_id" => 1,
        "password" => Hash::make("password"),
    ]);

    return response()->json($user, 200);
>>>>>>> 4db7692dd5f47278bc7d76e7a7731a38ae19fcc1
});

Route::get('/product/{product}/add/{subcategory}', function($product, $subcategory) {
    $pd = Products::find($product);
    $sub = SubCategory::find($subcategory);

    $pd->consumables()->attach($subcategory);

    $cons = $pd->consumables;


    return response()->json($cons, 200);
});


Route::get('/test', function() {
    return "Run";
});
