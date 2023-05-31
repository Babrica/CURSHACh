<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\EmployeeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/', [MainController::class, 'index']);
//Route::get('/potable', [MainController::class, 'potable']);
//Route::get('/combo', [MainController::class, 'combo']);
////Route::get('/adminpanel/product/add', [MainController::class, 'store']);
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

Route::get('/category/{category}', [MainController::class, 'category']);
Route::put('/setemployee/{id}', [EmployeeController::class, 'setEmployee']);
Route::put('/unemployee/{id}', [EmployeeController::class, 'unEmployee']);
//Route::get('/employees', [OrderController::class, 'employees']);


