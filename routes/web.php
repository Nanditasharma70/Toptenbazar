<?php

use App\Http\Controllers\Admin\Auth\AuthenticateController;
use App\Http\Controllers\Admin\Banner\BannerConfigController;
use App\Http\Controllers\Admin\Category\CatgoryController;
use App\Http\Controllers\Admin\ChargeConfig\ChargeConfigController;
use App\Http\Controllers\Admin\Coupon\CouponController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use App\Http\Controllers\Admin\Dashboard\HomeController as DashboardHomeController;
use App\Http\Controllers\Admin\Delivery\DeliveryController;
use App\Http\Controllers\Admin\ImageConfig\ImageConfigController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Product\ProductsController;
use App\Http\Controllers\Admin\ProductTag\ProductTagController;
use App\Http\Controllers\Admin\Reports\ReportController;
use App\Http\Controllers\Admin\SubCategory\SubCategoryController;
use App\Http\Controllers\Admin\Tax\TaxController;
use App\Http\Controllers\Admin\Unit\UnitController;
use App\Http\Controllers\Admin\Variation\VariationController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Middleware\RoleCheck;
use Illuminate\Support\Facades\Route;

#Website home page
Route::get('/', [HomeController::class,'home'])->name('home');
Route::get('admin/login',[AuthenticateController::class,'loginView'])->name('login');
Route::post('authenticate',[AuthenticateController::class,'authenticate'])->name('authenticate');
Route::get('/logout',[AuthenticateController::class,'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth:web','role:Admin'])->group(function () {
    
    #Admin Dashboard
    Route::get('dashboard', [DashboardHomeController::class,'dashboard'])->name('dashboard');

    #Products route
    Route::group(['prefix' => 'product'], function () {
        Route::get('', [ProductsController::class,'index'])->name('products.index');
        Route::get('/create', [ProductsController::class,'create'])->name('products.create');
        Route::post('/store', [ProductsController::class,'store'])->name('products.store');
        Route::get('/{id}/edit', [ProductsController::class,'edit'])->name('products.edit');
        Route::post('/{id}/update', [ProductsController::class,'update'])->name('products.update');
        Route::post('delete/{slug}',[ProductsController::class,'deleteProduct'])->name('products.delete');
    });


    #Category Route
    Route::group(['prefix' => 'category'], function () {
        Route::get('', [CatgoryController::class,'index'])->name('category.index');
        Route::get('/create', [CatgoryController::class,'create'])->name('category.create');
        Route::post('/store', [CatgoryController::class,'store'])->name('category.store');
        Route::get('/{id}/edit', [CatgoryController::class,'edit'])->name('category.edit');
        Route::post('delete/{slug}',[CatgoryController::class,'deleteCategory'])->name('category.delete');
        Route::post('/{id}/update', [CatgoryController::class,'update'])->name('category.update');
        Route::get('favourite-status',[CatgoryController::class,'makeFaourite'])->name('favourite-status');
    });

    #Variations
    Route::group(['prefix' => 'variation'], function () {
        Route::get('', [VariationController::class,'index'])->name('variation.index');
        Route::get('change-variation-status',[VariationController::class,'changeVariationStatus'])->name('change-variation-status');
        Route::post('delete/{slug}',[VariationController::class,'deleteVariation'])->name('variation.delete');
        Route::get('/create', [VariationController::class,'create'])->name('variation.create');
        Route::post('/store', [VariationController::class,'store'])->name('variation.store');
        // Route::get('/{id}/edit', [VariationController::class,'edit'])->name('variation.edit');
        // Route::post('/{id}/update', [VariationController::class,'update'])->name('variation.update');
    });

    #Units
        Route::group(['prefix' => 'unit'], function () {
        Route::match(['get','post'],'', [UnitController::class,'index'])->name('unit.index');
        Route::get('change-unit-status',[UnitController::class,'changeUnitStatus'])->name('change-unit-status');
        Route::get('/create', [UnitController::class,'create'])->name('unit.create');
        Route::post('/store', [UnitController::class,'store'])->name('unit.store');
        Route::post('delete/{slug}',[UnitController::class,'deleteUnit'])->name('unit.delete');
        // Route::get('/{id}/edit', [UnitController::class,'edit'])->name('unit.edit');
        // Route::post('/{id}/update', [UnitController::class,'update'])->name('unit.update');
    });

    #Sub Categories
        Route::group(['prefix' => 'sub-categories'], function () {
        Route::match(['get','post'],'', [SubCategoryController::class,'index'])->name('sub-categories.index');
        
        Route::get('/create', [SubCategoryController::class,'create'])->name('sub-categories.create');
        Route::post('/store', [SubCategoryController::class,'store'])->name('sub-categories.store');
        Route::post('delete/{slug}',[SubCategoryController::class,'deleteSubCat'])->name('sub-categories.delete');
        // Route::get('edit/{id}', [SubCategoryController::class,'edit'])->name('sub-categories.edit');
        // Route::post('update/{id}', [SubCategoryController::class,'update'])->name('sub-categories.update');
        });

    #Product Tags
     Route::group(['prefix' => 'product-tag'], function () {
        Route::match(['get','post'],'',[ProductTagController::class,'index'])->name('product-tag.index');
        Route::get('change-tag-status',[ProductTagController::class,'changeTagStatus'])->name('change-tag-status');
        Route::get('/create', [ProductTagController::class,'create'])->name('product-tag.create');
        Route::post('/store', [ProductTagController::class,'store'])->name('product-tag.store');
        Route::post('delete/{slug}',[ProductTagController::class,'deleteTag'])->name('product-tag.delete');
     });

     #Order
        Route::group(['prefix' => 'order'], function () {
        Route::get('', [OrderController::class,'index'])->name('order.index');
    });

     #customer
        Route::group(['prefix' => 'customer'], function () {
        Route::get('', [CustomerController::class,'index'])->name('customer.index');
        Route::get('change-customer-status',[CustomerController::class,'changeCustomerStatus'])->name('change-customer-status');

    });

     #Delivery Man
        Route::group(['prefix' => 'delivery-man'], function () {
        Route::get('', [DeliveryController::class,'index'])->name('delivery-man.index');
        Route::get('/create', [DeliveryController::class,'create'])->name('delivery-man.create');
        Route::post('/store', [DeliveryController::class,'store'])->name('delivery-man.store');
        Route::get('edit/{id}', [DeliveryController::class,'edit'])->name('delivery-man.edit');
        Route::post('update/{id}', [DeliveryController::class,'update'])->name('delivery-man.update');
        Route::post('delete/{slug}',[DeliveryController::class,'delete'])->name('delivery-man.delete');

    });

    #Reports Routes
     Route::group(['prefix' => 'reports'], function () {
        Route::get('category-sales', [ReportController::class,'categorySalesIndex'])->name('category-sales.index');
        Route::get('order-report', [ReportController::class,'orderReportIndex'])->name('order-report.index');
        Route::get('product-sales', [ReportController::class,'productSalesIndex'])->name('product-sales.index');
        Route::get('delivery-status', [ReportController::class,'deliveryStatusIndex'])->name('delivery-status.index');
     });

      #Banner Config Routes
     Route::group(['prefix' => 'banner-config'], function () {
        Route::get('', [BannerConfigController::class,'index'])->name('banner.index');
        Route::get('create', [BannerConfigController::class,'create'])->name('banner.create');  
        Route::post('/store', [BannerConfigController::class,'store'])->name('banner.store');
        Route::post('delete/{slug}',[BannerConfigController::class,'delete'])->name('banner.delete');     
     });

     #Charge Config
      Route::group(['prefix' => 'charge-config'], function () {
        Route::get('', [ChargeConfigController::class,'index'])->name('charge.index');
        Route::get('create', [ChargeConfigController::class,'create'])->name('charge.create');  
        Route::post('store', [ChargeConfigController::class,'store'])->name('charge.store');  
        Route::get('set-charge-config',[ChargeConfigController::class,'setChargeConfig'])->name('charge-config.create');
        Route::get('test-config', [ChargeConfigController::class,'testConfig'])->name('charge.testconfig');       
     });

     #Coupon
      Route::group(['prefix' => 'coupon'], function () {
        Route::get('', [CouponController::class,'index'])->name('coupon.index');
        Route::get('create', [CouponController::class,'create'])->name('coupon.create');  
        Route::post('/store', [CouponController::class,'store'])->name('coupon.store');
        Route::get('edit/{id}', [CouponController::class,'edit'])->name('coupon.edit');
        Route::post('update/{id}', [CouponController::class,'update'])->name('coupon.update');
        Route::post('delete/{slug}',[CouponController::class,'delete'])->name('coupon.delete');     
     });

     #Image Configuration
     Route::group(['prefix' => 'image-config'], function () {
        Route::get('', [ImageConfigController::class,'imageConfig'])->name('image-config.index');
        Route::get('create', [ImageConfigController::class,'imageCreate'])->name('image-config.create');
        Route::post('/store', [ImageConfigController::class,'imageStore'])->name('image-config.store');
        Route::post('delete/{slug}',[ImageConfigController::class,'delete'])->name('image-config.delete');
     });
     
});
  

