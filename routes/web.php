<?php

use App\Http\Controllers\PetitionController;

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

Route::get('/petitions',[PetitionController::class,'viewPetitions'])->name('petitions.index');
Route::get('/petitions/{id}',[PetitionController::class,'showPetition'])->name('petitions.show');
Route::put('/petitions/{id}',[PetitionController::class,'handlePetition'])->name('petition.handle');

Route::get('/order/{order_id}/exchange', [PetitionController::class, 'sendExchangeRequest']);
Route::get('/order/{order_id}/return', [PetitionController::class, 'sendReturnRequest']);
Route::get('/product/{product_id}/quantity', [PetitionController::class, 'getProductQuantity']);

// Route::get('/', function () {
//     return view('welcome');
// });

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
