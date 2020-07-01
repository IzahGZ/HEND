<?php
use Illuminate\Support\Facades\Route;
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
Route::get('/Login', 'LoginController@index')->name('login.index');
Route::get('/Registration', 'LoginController@register')->name('register.index');
Route::post('registerStore', 'LoginController@storeRegistration')->name('register.store');


//DASHBOARD======================================================================================================================================
// Route::get('/', function() {
//     return redirect('/index');
// });

Route::get('/index', 'DashboardController@index');

//ORDER=======================================================================================================================================
Route::get('order', ['as'=> 'order.index', 'uses' => 'OrderController@index']);
Route::get('order/create', 'OrderController@create')->name('order.create');
Route::post('ordersStore', ['as'=> 'orders.store', 'uses' => 'OrderController@store']);
Route::get('order/download/{id}', 'OrderController@downloadPDF')->name('order.download');

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
Route::get('rawMaterial/{rawMaterial}/edit', ['as'=> 'rawMaterial.edit', 'uses' => 'RawMaterialController@edit']);
Route::put('rawMaterial/{rawMaterial}', ['as'=> 'rawMaterial.update', 'uses' => 'RawMaterialController@update']);
Route::patch('rawMaterial/{rawMaterial}', ['as'=> 'rawMaterial.update', 'uses' => 'RawMaterialController@update']);
Route::get('rawMaterial/create', 'RawMaterialController@create')->name('RawMaterial.create');
Route::post('rawMaterialsStore', ['as'=> 'rawMaterials.store', 'uses' => 'RawMaterialController@store']);
Route::get('rawMaterial/download', 'RawMaterialController@downloadPDF')->name('RawMaterial.download');

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
Route::get('product/download', 'ProductController@downloadPDF')->name('Product.download');


//BILL OF MATERIALS=================================================================================================================================
//PROJECTS      
Route::get('project', ['as'=> 'project.index', 'uses' => 'ProjectController@index']);
Route::get('project/{project}/view}', array('as' => 'project.view', 'uses' => 'ProjectController@view'));
Route::get('project/{project}/edit', ['as'=> 'project.edit', 'uses' => 'ProjectController@edit']);
Route::put('project/{project}', ['as'=> 'project.update', 'uses' => 'ProjectController@update']);
Route::patch('project/{project}', ['as'=> 'project.update', 'uses' => 'ProjectController@update']);
Route::get('project/{id}/delete', array('as' => 'project.delete', 'uses' => 'ProjectController@getDelete'));
Route::get('project/{id}/confirm-delete', array('as' => 'project.confirm-delete', 'uses' => 'ProjectController@getModalDelete'));
Route::get('project/create', 'ProjectController@create')->name('Project.create');
Route::post('projectsStore', ['as'=> 'projects.store', 'uses' => 'ProjectController@store']);

//BOM     
Route::get('bom', ['as'=> 'bom.index', 'uses' => 'BomController@index']);
Route::get('bom/{bom}/view}', array('as' => 'bom.view', 'uses' => 'BomController@view'));


//PURCHASES=================================================================================================================================
//REQUEST OF PURCHASES      
Route::get('requestOfPurchase', ['as'=> 'requestOfPurchase.index', 'uses' => 'RequestOfPurchaseController@index']);
Route::get('requestOfPurchase/{id}/edit', ['as'=> 'requestOfPurchase.edit', 'uses' => 'RequestOfPurchaseController@edit']);
Route::put('requestOfPurchase/{id}', ['as'=> 'requestOfPurchase.update', 'uses' => 'RequestOfPurchaseController@update']);
Route::patch('requestOfPurchase/{id}', ['as'=> 'requestOfPurchase.update', 'uses' => 'RequestOfPurchaseController@update']);
Route::get('requestOfPurchase/create', 'RequestOfPurchaseController@create')->name('requestOfPurchase.create');
Route::post('requestOfPurchaseStore', ['as'=> 'requestOfPurchase.store', 'uses' => 'RequestOfPurchaseController@store']);
Route::get('requestOfPurchaseStore/download/{id}', 'RequestOfPurchaseController@downloadPDF')->name('requestOfPurchaseStore.download');

//PURCHASE ORDERS      
Route::get('purchaseOrder', ['as'=> 'purchaseOrder.index', 'uses' => 'PurchaseOrderController@index']);
Route::get('purchaseOrder/create', 'PurchaseOrderController@create')->name('purchaseOrder.create');
Route::post('purchaseOrder', ['as'=> 'purchaseOrder.store', 'uses' => 'PurchaseOrderController@store']);
Route::get('purchaseOrder/download/{id}', 'PurchaseOrderController@downloadPDF')->name('purchaseOrder.download');


//STOCKS=================================================================================================================================
//GOOD RECEIVE NOTE     
Route::get('goodReceiveNote', ['as'=> 'goodReceiveNote.index', 'uses' => 'GoodReceiveNoteController@index']);
Route::get('goodReceiveNote/create', 'GoodReceiveNoteController@create')->name('goodReceiveNote.create');
Route::post('goodReceiveNoteStore', ['as'=> 'goodReceiveNote.store', 'uses' => 'GoodReceiveNoteController@store']);
Route::get('goodReceiveNoteStore/download/{id}', 'GoodReceiveNoteController@downloadPDF')->name('goodReceiveNoteStore.download');

//TRANSACTION HISTORY     
Route::get('inventoryStockTransaction', ['as'=> 'inventoryStockTransaction.index', 'uses' => 'InventoryStockTransactionController@index']);


//MRP=====================================================================================================================================    
Route::get('mrp', ['as'=> 'mrp.index', 'uses' => 'MrpController@index']);
Route::post('generateMrp', ['as'=> 'generateMrp.store', 'uses' => 'MrpController@generateMrp']);
Route::put('LotSeizing/{id}', ['as'=> 'LotSeizing.index', 'uses' => 'MrpController@LotSeizing']);
Route::patch('LotSeizing/{id}', ['as'=> 'LotSeizing.index', 'uses' => 'MrpController@LotSeizing']);
Route::get('purchaseRequest/{id}/pr', array('as' => 'purchaseRequest.pr', 'uses' => 'MrpController@getPR'));
Route::get('purchaseRequest/{id}/confirm-pr', array('as' => 'purchaseRequest.confirm-pr', 'uses' => 'MrpController@getModalPR'));
Route::get('Mrp/downloadMrpPDF/{id}', 'MrpController@downloadMrpPDF')->name('Mrp.downloadMrpPDF');


//PRODUCTION=============================================================================================================================  
//WORK ORDERS    
Route::get('workOrder', ['as'=> 'workOrder.index', 'uses' => 'WorkOrderController@index']);
Route::get('workOrder/create', 'WorkOrderController@create')->name('workOrder.create');
Route::post('workOrder', ['as'=> 'workOrder.store', 'uses' => 'WorkOrderController@store']);
Route::get('workOrder/download/{id}', 'WorkOrderController@downloadPDF')->name('workOrder.download');
Route::get('workOrder/downloadProcessTravellerPDF/{id}', 'WorkOrderController@downloadProcessTravellerPDF')->name('workOrder.downloadProcessTravellerPDF');
Route::get('workOrder/{id}/wo', array('as' => 'workOrder.wo', 'uses' => 'WorkOrderController@getWO'));
Route::get('workOrder/{id}/confirm-wo', array('as' => 'workOrder.confirm-wo', 'uses' => 'WorkOrderController@getModalWO'));
//RUN PRODUCTION
Route::get('workOrder/{id}/production', array('as' => 'workOrder.production', 'uses' => 'WorkOrderController@getProduction'));
Route::get('workOrder/{id}/confirm-production', array('as' => 'workOrder.confirm-production', 'uses' => 'WorkOrderController@getModalProduction'));
//FINISH GOOD PRODUCTION
Route::get('finishGoodProduction', ['as'=> 'finishGoodProduction.create', 'uses' => 'WorkOrderController@finishGoodProductionCreate']);
Route::post('finishGoodProductionStore', ['as'=> 'finishGoodProduction.store', 'uses' => 'WorkOrderController@finishGoodProductionStore']);


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

//MINIMUM ORDER QUANTITY (MOQ)============================================================================================================================
Route::get('moq', ['as'=> 'moq.index', 'uses' => 'MoqController@index']);
Route::get('moq/{id}/view}', array('as' => 'moq.view', 'uses' => 'MoqController@view'));
Route::get('moq/{id}/edit', ['as'=> 'moq.edit', 'uses' => 'MoqController@edit']);
Route::put('moq/{id}', ['as'=> 'moq.update', 'uses' => 'MoqController@update']);
Route::patch('moq/{id}', ['as'=> 'moq.update', 'uses' => 'MoqController@update']);
Route::get('moq/{id}/delete', array('as' => 'moq.delete', 'uses' => 'MoqController@getDelete'));
Route::get('moq/{id}/confirm-delete', array('as' => 'moq.confirm-delete', 'uses' => 'MoqController@getModalDelete'));
Route::get('moq/create', 'MoqController@create')->name('moq.create');
Route::post('moqStore', ['as'=> 'moq.store', 'uses' => 'MoqController@store']);

