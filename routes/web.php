<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('form');
// });

Route::get('/',[PostController::class, 'index']);
Route::get('bucketData',[PostController::class, 'bucketData']);
Route::post('checkBucket',[PostController::class, 'checkBucket']);
Route::post('storeData-form', [PostController::class, 'storeData']);
Route::post('createBucket', [PostController::class, 'createBucket']);
Route::post('createBall', [PostController::class, 'createBall']);


