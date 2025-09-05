<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\ProductHierarchyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Route::post('/login', [AuthenticationController::class, 'login']);
// Route::post('/verify-otp', [AuthenticationController::class, 'verifyOtp']);
Route::post('/signup',[AuthenticationController::class,'signup']);
Route::middleware(['auth:sanctum'])->group(function () {

    #categories
    Route::get('getCategories',[ProductHierarchyController::class,'getCategories']);
    Route::get('get-sub-categories/{id}',[ProductHierarchyController::class,'getSubCategoriesOfCategory']);
    Route::post('/logout',[AuthenticationController::class,'logout']);

    #products
    Route::get('get-subcategory-products/{id}',[ProductHierarchyController::class,'getSubCategoryProducts'])->name('subCateg.products');

    #Account profile
    Route::get('get-profile',[AuthenticationController::class,'getProfile']);
    Route::post('update-profile/{id}',[AuthenticationController::class,'updateProfile'])->name('update-profile');
});


