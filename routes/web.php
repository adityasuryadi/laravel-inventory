<?php

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



Route::get('login',['uses'=>'AuthController@login','as'=>'login']);
Route::post('authentication',['uses'=>'AuthController@authentication','as'=>'authentication']);

Route::middleware(['auth'])->group(function(){
    Route::get('/', 'PageController@dashboard');
    Route::resource('article','ArticleController');
    Route::resource('product','ProductController');
    Route::resource('sysvalue','SysValueController');
    Route::resource('sales','SalesController');
    Route::get('sales/{id}/invoice','SalesController@printInvoice');
    Route::get('sales/{id}/suratjalan','SalesController@printSuratJalan');
    Route::get('sales/{id}/process','SalesController@processInvoice')->name('invoice.process');

    Route::resource('customer','CustomerController');
    Route::resource('supplier','SupplierCOntroller');
    Route::resource('purchases','PurchasesController');
    Route::resource('permission','PermissionController');
    Route::resource('role','RoleController');
    Route::resource('user','UserController');
    Route::get('user/{id}/profile',['uses'=>'UserController@editProfile','as'=>'edit.profile']);
    Route::PUT('user/{id}/updateprofile',['uses'=>'UserController@updateProfile','as'=>'update.profile']);
    Route::resource('company','CompanyController');
    Route::PUT('payment/{id}',['uses'=>'SalesPaymentController@inputPayment','as'=>'input.payment']);
    Route::PUT('purchasespayment/{id}',['uses'=>'PurchasesPaymentController@inputPayment','as'=>'purchases.payment']);
    Route::get('customer/balance/{id}',['uses'=>'CustomerController@reportCustomerBalance','as'=>'customer.balance']);
    Route::get('supplier/balance/{id}',['uses'=>'SupplierController@reportSupplierBalance','as'=>'supplier.balance']);
    Route::get('report','PageController@report');
    Route::get('reportglobal',['uses'=>'PageController@getReportDataGlobal','as'=>'report.global']);
    // Route::get('report',function(){
    //     return view('backend.report.sales_report')->withTitle('Laporan Penjualan');
    // });

    Route::resource('carbrands','BrandCarController');
    Route::resource('cars','CarController');
    Route::resource('windshield','WindShieldController');
    Route::resource('windshieldpart','WindShieldPartController');
    Route::resource('windshieldbrand','WindShieldBrandController');
    Route::resource('rack','RackController');

    Route::get('logout',['uses'=>'AuthController@logout','as'=>'logout']);
});

