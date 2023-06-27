<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\UserAuthController;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', [UserAuthController::class, 'loginUser']);
Route::post('register', [UserAuthController::class, 'registerUser']);

Route::group(['middleware' => 'auth:sanctum'], function (){
    Route::get('userdetails', [UserAuthController::class, 'userDetails']);
    Route::get('logout', [UserAuthController::class, 'logout']);

    Route::apiResources(['/product' => MainController::class,]);

    Route::apiResources(['/user' => UserController::class,]);

    Route::apiResources(['/order' => OrderController::class,]);

    Route::apiResources(['/employee' => EmployeeController::class,]);

    Route::apiResources(['/basket' => BasketController::class,]);

    Route::get('/category/{category}', [MainController::class, 'category']);
    Route::put('/setemployee/{id}', [EmployeeController::class, 'setEmployee']);
    Route::put('/unemployee/{id}', [EmployeeController::class, 'unEmployee']);
});





