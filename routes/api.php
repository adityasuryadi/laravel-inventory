<?php

use Illuminate\Http\Request;

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

Route::get('articles','ArticleController@getArticles');

Route::get('products','ProductController@getProducts');

Route::get('products/{id}','ProductController@getProductByArticle');

Route::get('sysvalues/{name}','SysValueCOntroller@getSysValue');

Route::get('customers','CustomerCOntroller@getCustomers');

Route::get('suppliers','SupplierController@getSuppliers');

Route::get('companies','CompanyController@getCompanies');

Route::get('carbrands','BrandCarController@getBrands');

Route::get('windshieldbrands','WindShieldBrandController@getBrands');

Route::get('windshieldparts','WindShieldPartController@getParts');

Route::get('racks','RackController@getRacks');

Route::get('windshields','WindShieldController@getWindShields');