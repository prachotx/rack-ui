<?php

use App\Models\Rack;
use App\Models\PackingDetail;
use App\Models\Packing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PackingController;
use App\Http\Controllers\CheckOutController;
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


Route::post('/login', [LoginController::class, 'loginapp']);

Route::get('/checkin', [PackingController::class, 'checkinapp']);

Route::get('/approve', [PackingController::class, 'approveapp']);

Route::get('/checkout', [CheckOutController::class, 'checkoutapp']);