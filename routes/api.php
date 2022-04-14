<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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

// Route::get("/products",[ProductController::class,'index']);



Route::post("register",[AuthController::class,'register']);
Route::post("login",[AuthController::class,'login']);

Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get("/products",[ProductController::class,'index']);
    Route::post("/new-products",[ProductController::class,'store']);
    Route::get("/product/{id}",[ProductController::class,'show']);
    Route::put("/update-product/{id}",[ProductController::class,'update']);
    Route::delete("/delete-product/{id}",[ProductController::class,'destroy']);
    Route::get("/search-product/{name}",[ProductController::class,'search']);
    Route::post("/logout",[AuthController::class,'logout']);
});
