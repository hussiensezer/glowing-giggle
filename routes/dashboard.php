<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Dashboard" middleware group. Now create something great!
|
*/
//[-------------------------------------------- Auth Routes --------------------------------------------]

Route::get('dashboard/login', [\App\Http\Controllers\Dashboard\Auth\LoginController::class,'login'])->name('dashboard.login');
Route::post('dashboard/login', [\App\Http\Controllers\Dashboard\Auth\LoginController::class,'loginProcess'])->name('dashboard.login');
Route::post('dashboard/logout', [\App\Http\Controllers\Dashboard\Auth\LogoutController::class,'logout'])->name('dashboard.logout');

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    Route::group(['prefix' => 'dashboard', 'name' => 'dashboard.'/*, 'middleware' => 'auth:users'*/],function(){

        Route::get('/confirm-password', [\App\Http\Controllers\Dashboard\Auth\ConfirmPasswordController::class,'view'])->name('password.confirm');
        Route::group(['middleware' => ['throttle:6,1']],function(){
            Route::post('/confirm-password', [\App\Http\Controllers\Dashboard\Auth\ConfirmPasswordController::class,'confirmPassword'])->name('confirm.password.process');

        });
        Route::get('index', [\App\Http\Controllers\Dashboard\HomeController::class, 'index'])->name('dashboard.index');
        Route::group(['prefix' => 'categories' , 'as' => 'dashboard.categories.'],function(){


            /*
             * Categories Product Routes
            */
            Route::get('product/index', [\App\Http\Controllers\Dashboard\Category\Product\ProductController::class,'index'])->name('product.index');
            Route::get('{category}/product/show', [\App\Http\Controllers\Dashboard\Category\Product\ProductController::class,'show'])->name('product.show');
            Route::get('product/create', [\App\Http\Controllers\Dashboard\Category\Product\ProductController::class,'create'])->name('product.create');
            Route::post('product/store', [\App\Http\Controllers\Dashboard\Category\Product\ProductController::class,'store'])->name('product.store');
            Route::get('{category}/product/edit', [\App\Http\Controllers\Dashboard\Category\Product\ProductController::class,'edit'])->name('product.edit');
            Route::put('{category}/product/update', [\App\Http\Controllers\Dashboard\Category\Product\ProductController::class,'update'])->name('product.update');
            Route::delete('{category}/product/destroy', [\App\Http\Controllers\Dashboard\Category\Product\ProductController::class,'destroy'])->name('product.destroy');


            Route::get('product/data',[\App\Http\Controllers\Dashboard\Category\Product\ProductCategoryController::class,'data']);
            Route::get('product/filter',[\App\Http\Controllers\Dashboard\Category\Product\ProductCategoryController::class,'filter']);
            Route::get('product/categories',[\App\Http\Controllers\Dashboard\Category\Product\ProductCategoryController::class,'categories']);
            Route::get('product/category/{category}/sub-categories',[\App\Http\Controllers\Dashboard\Category\Product\ProductCategoryController::class,'subCategories']);

            /*
             * Categories Item Routes
            */
            Route::get('item/index', [\App\Http\Controllers\Dashboard\Category\Item\ItemController::class,'index'])->name('item.index');
            Route::get('{category}/item/show', [\App\Http\Controllers\Dashboard\Category\Item\ItemController::class,'show'])->name('item.show');
            Route::get('item/create', [\App\Http\Controllers\Dashboard\Category\Item\ItemController::class,'create'])->name('item.create');
            Route::post('item/store', [\App\Http\Controllers\Dashboard\Category\Item\ItemController::class,'store'])->name('item.store');
            Route::get('{category}/item/edit', [\App\Http\Controllers\Dashboard\Category\Item\ItemController::class,'edit'])->name('item.edit');
            Route::put('{category}/item/update', [\App\Http\Controllers\Dashboard\Category\Item\ItemController::class,'update'])->name('item.update');
            Route::delete('{category}/item/destroy', [\App\Http\Controllers\Dashboard\Category\Item\ItemController::class,'destroy'])->name('item.destroy');
            /*
             * Api Categories Item Routes
             */
            Route::get('item/data',[\App\Http\Controllers\Dashboard\Category\Item\ItemCategoryController::class,'data']);
            Route::get('item/categories',[\App\Http\Controllers\Dashboard\Category\Item\ItemCategoryController::class,'categories']);
            Route::get('item/category/{category}/sub-categories',[\App\Http\Controllers\Dashboard\Category\Item\ItemCategoryController::class,'subCategories']);
            Route::get('item/filter',[\App\Http\Controllers\Dashboard\Category\Item\ItemCategoryController::class,'filter'])->name('item.filter');

        });// End Prefix Categories

        /*
         * Items Routes
        */
        Route::get('items/data', [\App\Http\Controllers\Dashboard\Item\ItemController::class, 'data'])->name('items.data');
        Route::resource('items', \App\Http\Controllers\Dashboard\Item\ItemController::class)->names([
            'index'     => 'dashboard.items.index',
            'show'      => 'dashboard.items.show',
            'create'    => 'dashboard.items.create',
            'store'     => 'dashboard.items.store',
            'edit'      => 'dashboard.items.edit',
            'update'    => 'dashboard.items.update',
        ]);

        /*
         * Products Routes
        */
        Route::get('products/data', [\App\Http\Controllers\Dashboard\Product\ProductController::class, 'data'])->name('products.data');
        Route::resource('products', \App\Http\Controllers\Dashboard\Product\ProductController::class)->names([
            'index'     => 'dashboard.products.index',
            'show'      => 'dashboard.products.show',
            'create'    => 'dashboard.products.create',
            'store'     => 'dashboard.products.store',
            'edit'      => 'dashboard.products.edit',
            'update'    => 'dashboard.products.update',
        ]);

        /*
         * Inventory Transaction Routes
        */
        Route::get('inventory/transaction/index',
            [\App\Http\Controllers\Dashboard\Inventory\InventoryTransactionController::class, 'index'])
            ->name('inventory.transaction.index');

        Route::get('inventory/transaction/data',
            [\App\Http\Controllers\Dashboard\Inventory\InventoryTransactionController::class, 'data'])
            ->name('inventory.transaction.data');

        Route::post('inventory/transaction/items/{item}/withdrew',
            [\App\Http\Controllers\Dashboard\Inventory\InventoryTransactionController::class,'itemWithdraw'])
            ->name('inventory.transaction.items.withdrew');

        Route::post('inventory/transaction/items/{item}/deposit',
            [\App\Http\Controllers\Dashboard\Inventory\InventoryTransactionController::class,'itemDeposit'])
            ->name('inventory.transaction.items.deposit');

        Route::post('inventory/transaction/products/{product}/withdrew',
            [\App\Http\Controllers\Dashboard\Inventory\InventoryTransactionController::class,'productWithdraw'])
            ->name('inventory.transaction.products.withdrew');

        Route::post('inventory/transaction/products/{product}/deposit',
            [\App\Http\Controllers\Dashboard\Inventory\InventoryTransactionController::class,'productDeposit'])
            ->name('inventory.transaction.products.deposit');

        /*
         * Inventory Setting Routes
        */
        Route::get('inventory/setting/index',
            [\App\Http\Controllers\Dashboard\Inventory\InventorySettingController::class,'index'])
            ->name('inventory.setting.index');

        Route::put('inventory/setting/update',
            [\App\Http\Controllers\Dashboard\Inventory\InventorySettingController::class,'update'])
            ->name('inventory.setting.update');


    });// End Prefix Dashboard
});


