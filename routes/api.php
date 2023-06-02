<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\BasketController;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResources
([
    '/product' => MainController::class,
]);

Route::apiResources
([
    '/user' => UserController::class,
]);

Route::apiResources
([
    '/order' => OrderController::class,
]);

Route::apiResources
([
    '/employee' => EmployeeController::class,
]);

Route::apiResources
([
    '/basket' => BasketController::class,
]);

Route::get('/category/{category}', [MainController::class, 'category']);
Route::put('/setemployee/{id}', [EmployeeController::class, 'setEmployee']);
Route::put('/unemployee/{id}', [EmployeeController::class, 'unEmployee']);


