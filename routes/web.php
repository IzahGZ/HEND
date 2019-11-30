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

//===============================================================================================================================================
//MAIN NAVIGATION
//===============================================================================================================================================

//DASHBOARD======================================================================================================================================
Route::get('/', function() {
    return redirect('/index');
});

Route::get('/index', function () {
    return view('index.dashboard');
});

//CUSTOMER=======================================================================================================================================
Route::get('customer', ['as'=> 'customer.index', 'uses' => 'CustomerController@index']);
Route::get('customer/{id}/view}', array('as' => 'customer.view', 'uses' => 'CustomerController@view'));
Route::get('customer/{id}/edit', ['as'=> 'customer.edit', 'uses' => 'CustomerController@edit']);
Route::put('customer/{id}', ['as'=> 'customer.update', 'uses' => 'CustomerController@update']);
Route::patch('customer/{id}', ['as'=> 'customer.update', 'uses' => 'CustomerController@update']);
Route::get('customer/{id}/delete', array('as' => 'customer.delete', 'uses' => 'CustomerController@getDelete'));
Route::get('customer/{id}/confirm-delete', array('as' => 'customer.confirm-delete', 'uses' => 'CustomerController@getModalDelete'));
Route::get('customer/create', 'CustomerController@create')->name('customer.create');
Route::post('customersStore', ['as'=> 'customers.store', 'uses' => 'CustomerController@store']);


//SUPPLIER========================================================================================================================================
Route::get('supplier', ['as'=> 'supplier.index', 'uses' => 'SupplierController@index']);
Route::get('supplier/{id}/view}', array('as' => 'supplier.view', 'uses' => 'SupplierController@view'));
Route::get('supplier/{id}/edit', ['as'=> 'supplier.edit', 'uses' => 'SupplierController@edit']);
Route::put('supplier/{id}', ['as'=> 'supplier.update', 'uses' => 'SupplierController@update']);
Route::patch('supplier/{id}', ['as'=> 'supplier.update', 'uses' => 'SupplierController@update']);
Route::get('supplier/{id}/delete', array('as' => 'supplier.delete', 'uses' => 'SupplierController@getDelete'));
Route::get('supplier/{id}/confirm-delete', array('as' => 'supplier.confirm-delete', 'uses' => 'SupplierController@getModalDelete'));
Route::get('supplier/create', 'SupplierController@create')->name('supplier.create');
Route::post('suppliersStore', ['as'=> 'suppliers.store', 'uses' => 'SupplierController@store']);


//INVENTORY=======================================================================================================================================
//RAW MATERIAL
Route::get('rawMaterial', ['as'=> 'rawMaterial.index', 'uses' => 'RawMaterialController@index']);
Route::get('rawMaterial/{id}/view}', array('as' => 'rawMaterial.view', 'uses' => 'RawMaterialController@view'));
Route::get('rawMaterial/{id}/edit', ['as'=> 'rawMaterial.edit', 'uses' => 'RawMaterialController@edit']);
Route::put('rawMaterial/{id}', ['as'=> 'rawMaterial.update', 'uses' => 'RawMaterialController@update']);
Route::patch('rawMaterial/{id}', ['as'=> 'rawMaterial.update', 'uses' => 'RawMaterialController@update']);
Route::get('rawMaterial/{id}/delete', array('as' => 'rawMaterial.delete', 'uses' => 'RawMaterialController@getDelete'));
Route::get('rawMaterial/{id}/confirm-delete', array('as' => 'rawMaterial.confirm-delete', 'uses' => 'RawMaterialController@getModalDelete'));
Route::get('rawMaterial/create', 'RawMaterialController@create')->name('RawMaterial.create');
Route::post('rawMaterialsStore', ['as'=> 'rawMaterials.store', 'uses' => 'RawMaterialController@store']);

//PRODUCT
Route::get('product', ['as'=> 'product.index', 'uses' => 'ProductController@index']);
Route::get('product/{id}/view}', array('as' => 'product.view', 'uses' => 'ProductController@view'));
Route::get('product/{id}/edit', ['as'=> 'product.edit', 'uses' => 'ProductController@edit']);
Route::put('product/{id}', ['as'=> 'product.update', 'uses' => 'ProductController@update']);
Route::patch('product/{id}', ['as'=> 'product.update', 'uses' => 'ProductController@update']);
Route::get('product/{id}/delete', array('as' => 'product.delete', 'uses' => 'ProductController@getDelete'));
Route::get('product/{id}/confirm-delete', array('as' => 'product.confirm-delete', 'uses' => 'ProductController@getModalDelete'));
Route::get('product/create', 'ProductController@create')->name('Product.create');
Route::post('productsStore', ['as'=> 'products.store', 'uses' => 'ProductController@store']);


//BILL OF MATERIALS=================================================================================================================================
//PROJECTS      
Route::get('project', ['as'=> 'project.index', 'uses' => 'ProjectController@index']);
Route::get('project/{id}/view}', array('as' => 'project.view', 'uses' => 'ProjectController@view'));
Route::get('project/{project}/edit', ['as'=> 'project.edit', 'uses' => 'ProjectController@edit']);
Route::put('project/{project}', ['as'=> 'project.update', 'uses' => 'ProjectController@update']);
Route::patch('project/{project}', ['as'=> 'project.update', 'uses' => 'ProjectController@update']);
Route::get('project/{id}/delete', array('as' => 'project.delete', 'uses' => 'ProjectController@getDelete'));
Route::get('project/{id}/confirm-delete', array('as' => 'project.confirm-delete', 'uses' => 'ProjectController@getModalDelete'));
Route::get('project/create', 'ProjectController@create')->name('Project.create');
Route::post('projectsStore', ['as'=> 'projects.store', 'uses' => 'ProjectController@store']);

//===============================================================================================================================================
//SETTING
//===============================================================================================================================================

//SYSTEM STATUS==================================================================================================================================
Route::get('systemStatus', ['as'=> 'systemStatus.index', 'uses' => 'SystemStatusController@index']);
Route::get('systemStatus/{id}/view}', array('as' => 'systemStatus.view', 'uses' => 'SystemStatusController@view'));
Route::get('systemStatus/{id}/edit', ['as'=> 'systemStatus.edit', 'uses' => 'SystemStatusController@edit']);
Route::put('systemStatus/{id}', ['as'=> 'systemStatus.update', 'uses' => 'SystemStatusController@update']);
Route::patch('systemStatus/{id}', ['as'=> 'systemStatus.update', 'uses' => 'SystemStatusController@update']);
Route::get('systemStatus/{id}/delete', array('as' => 'systemStatus.delete', 'uses' => 'SystemStatusController@getDelete'));
Route::get('systemStatus/{id}/confirm-delete', array('as' => 'systemStatus.confirm-delete', 'uses' => 'SystemStatusController@getModalDelete'));
Route::get('systemStatus/create', 'SystemStatusController@create')->name('SystemStatus.create');
Route::post('systemStatusStore', ['as'=> 'systemStatus.store', 'uses' => 'SystemStatusController@store']);


//UNIT OF MEASUREMENT============================================================================================================================
Route::get('uom', ['as'=> 'uom.index', 'uses' => 'UomController@index']);
Route::get('uom/{id}/view}', array('as' => 'uom.view', 'uses' => 'UomController@view'));
Route::get('uom/{id}/edit', ['as'=> 'uom.edit', 'uses' => 'UomController@edit']);
Route::put('uom/{id}', ['as'=> 'uom.update', 'uses' => 'UomController@update']);
Route::patch('uom/{id}', ['as'=> 'uom.update', 'uses' => 'UomController@update']);
Route::get('uom/{id}/delete', array('as' => 'uom.delete', 'uses' => 'UomController@getDelete'));
Route::get('uom/{id}/confirm-delete', array('as' => 'uom.confirm-delete', 'uses' => 'UomController@getModalDelete'));
Route::get('uom/create', 'UomController@create')->name('Uom.create');
Route::post('uomStore', ['as'=> 'uom.store', 'uses' => 'UomController@store']);

Route::group([
    'prefix' => 'process',
    'as' => 'process.'
], function() {
    Route::get('process/process_data', 'ProcessController@process_data')->name('data');
});
Route::resource('process', 'ProcessController');

