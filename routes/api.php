<?php

use App\Http\Controllers\ApiController;

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

Route::get('/product/{order_id}/{product_id}', [ApiController::class, 'productExist']);
Route::get('/petition/{order_id}/{product_id}', [ApiController::class, 'show']);
Route::post('/petition/{order_id}/{product_id}/create', [ApiController::class,'store'])->name('petition.store');


