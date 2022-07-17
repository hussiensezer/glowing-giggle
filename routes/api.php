<?php

use App\Http\Controllers\Dashboard\Category\Product\ProductController;
use App\Http\Controllers\Dashboard\Item\AttachmentController;
use App\Http\Controllers\Dashboard\Item\BaseInformationController;
use App\Http\Controllers\Dashboard\Measurement\MeasurementController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('product/store', [ProductController::class,'store'])->name('product.store');
Route::post('category/{category}/product/update', [ProductController::class,'update'])->name('product.update');
Route::post('measurement/store', [MeasurementController::class,'store']);
Route::post('item/{item}/attachment/image/store', [AttachmentController::class,'storeImage']);
Route::post('item/{item}/attachment/document/store', [AttachmentController::class,'storeDocument']);
Route::delete('item/{item}/attachment/document/{document}/destroy', [AttachmentController::class,'destroyDocument']);
Route::delete('item/{item}/attachment/image/{image}/destroy', [AttachmentController::class,'destroyImage']);
Route::post('item/{item}/base-information/update',[BaseInformationController::class, 'updateBaseInformation']);

Route::post('item/{item}/attributes/store',[\App\Http\Controllers\Dashboard\Item\AttributeController::class, 'store']);
Route::post('item/{item}/attributes/{attribute}/update',[\App\Http\Controllers\Dashboard\Item\AttributeController::class, 'update']);

Route::post('item/{item}/complex-attributes/store', [\App\Http\Controllers\Dashboard\Item\ComplexAttributeController::class,'store']);
Route::post('item/{item}/complex-attributes/{complex_attribute}/destroy', [\App\Http\Controllers\Dashboard\Item\ComplexAttributeController::class,'destroy']);

Route::post('item/store', [\App\Http\Controllers\Dashboard\Item\ItemController::class,'store']);
Route::get('item/{item}/edit', [\App\Http\Controllers\Dashboard\Item\ItemController::class,'edit']);
Route::get('item/index', [\App\Http\Controllers\Dashboard\Item\ItemController::class,'index']);

    Route::post('item/{item}/withdrew', [\App\Http\Controllers\Dashboard\Inventory\InventoryTransactionController::class, 'itemWithdraw']);
    Route::post('item/{item}/deposit', [\App\Http\Controllers\Dashboard\Inventory\InventoryTransactionController::class, 'itemDeposit']);
    Route::get('items/report',[\App\Http\Controllers\Dashboard\Inventory\Reports\ItemReportController::class, 'report']);
//Route::post('manufacturingProcesses/store', [\App\Http\Controllers\Dashboard\ManufacturingProcessController::class,'store']);

Route::post('product/{product}/manufacturing-process/store', [\App\Http\Controllers\Dashboard\Product\ManufacturingProcessController::class,'store']);
Route::post('product/{product}/manufacturing-process/{manufacturing}/update', [\App\Http\Controllers\Dashboard\Product\ManufacturingProcessController::class,'update']);
Route::post('product/{product}/manufacturing-process/{manufacturing}/destroy', [\App\Http\Controllers\Dashboard\Product\ManufacturingProcessController::class,'destroy']);
Route::post('product/{product}/items/{item}/update',[\App\Http\Controllers\Dashboard\Product\ItemController::class, 'update']);
Route::post('product/{product}/items/store',[\App\Http\Controllers\Dashboard\Product\ItemController::class, 'store']);
Route::post('products/store', [\App\Http\Controllers\Dashboard\Product\ProductController::class,'store']);


Route::post('inventory/setting/update', [\App\Http\Controllers\Dashboard\Inventory\InventorySettingController::class, 'update']);



Route::get('categories/search', [\App\Http\Controllers\Dashboard\Category\Product\ProductController::class,'search']);

Route::post('attributes/{attribute}/update', [\App\Http\Controllers\Dashboard\Attribute\AttributeController::class,'update'])->name('attributes.update');

Route::post('manufacturing-processes/store',[ \App\Http\Controllers\Dashboard\ManufacturingProcess\ManufacturingProcessController::class,'store']);
Route::post('manufacturing-processes/{manufacturing_process}/update',[ \App\Http\Controllers\Dashboard\ManufacturingProcess\ManufacturingProcessController::class,'update']);
Route::get('manufacturing-processes/index',[ \App\Http\Controllers\Dashboard\ManufacturingProcess\ManufacturingProcessController::class,'manufacturing_process']);

Route::post('test', [\App\Http\Controllers\Dashboard\Category\Item\ItemController::class, 'test']);

Route::get('roles/index', [\App\Http\Controllers\Dashboard\Role\RoleController::class,'index']);
Route::get('roles/create', [\App\Http\Controllers\Dashboard\Role\RoleController::class,'create']);
Route::post('roles/store', [\App\Http\Controllers\Dashboard\Role\RoleController::class,'store']);
Route::get('roles/{role}/edit', [\App\Http\Controllers\Dashboard\Role\RoleController::class,'edit']);
Route::post('roles/{role}/update', [\App\Http\Controllers\Dashboard\Role\RoleController::class,'update']);
Route::post('roles/{role}/destroy', [\App\Http\Controllers\Dashboard\Role\RoleController::class,'destroy']);


Route::get('users/index', [\App\Http\Controllers\Dashboard\User\UserController::class,'index']);
Route::post('users/store', [\App\Http\Controllers\Dashboard\User\UserController::class,'store']);
