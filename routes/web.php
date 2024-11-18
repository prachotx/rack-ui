<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\CheckOutDetailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PackingController;
use App\Http\Controllers\PackingDetailController;
use App\Http\Controllers\PalletController;
use App\Http\Controllers\PalletTypeController;
use App\Http\Controllers\ProcessPalletController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\UserController;
use App\Models\CheckOutDetail;
use App\Http\Controllers\ReportItemsController;

Route::get('/', [AdminController::class,'dashboard']);
Route::get('/home', [AdminController::class,'dashboard'])->name('home');

Route::get('/users', [UserController::class,'index']);
Route::get('/edit_user/{id}', [UserController::class,'edit']);
Route::post('/update_user/{id}', [UserController::class,'update']);
Route::get('/add_user', [UserController::class,'add']);
Route::post('/create_user', [UserController::class,'create']);
Route::get('/change_password/{id}', [UserController::class,'change_password']);
Route::post('/update_password/{id}', [UserController::class,'update_password']);

Route::get('/reports', [ReportItemsController::class, 'index']);

Route::get('/branches', [BranchController::class,'index']);
Route::get('/edit_branch/{id}', [BranchController::class,'edit']);
Route::post('/update_branch/{id}', [BranchController::class,'update']);
Route::get('/add_branch', [BranchController::class,'add']);
Route::post('/create_branch', [BranchController::class,'create']);
Route::post('/delete_branch/{id}', [BranchController::class,'delete']);



Route::get('/locations', [LocationController::class,'index']);
Route::get('/edit_location/{id}', [LocationController::class,'edit']);
Route::post('/update_location/{id}', [LocationController::class,'update']);
Route::get('/add_location', [LocationController::class,'add']);
Route::post('/create_location', [LocationController::class,'create']);
Route::post('/delete_location/{id}', [LocationController::class,'delete']);


Route::get('/racks', [RackController::class,'index']);
Route::get('/add_rack', [RackController::class,'add']);
Route::post('/create_rack', [RackController::class,'create']);
Route::get('/edit_rack/{id}', [RackController::class,'edit']);
Route::post('/update_rack/{id}', [RackController::class,'update']);
Route::post('/confirm_rack/{id}', [RackController::class,'confirm']);
Route::post('/delete_rack/{id}', [RackController::class,'delete']);
Route::get('/view_rack/{id}', [RackController::class,'view']);
Route::post('/disable_rack/{id}', [RackController::class,'disable']);
Route::post('/enable_rack/{id}', [RackController::class,'enable']);


Route::get('/product_types', [ProductTypeController::class,'index']);
Route::get('/edit_product_type/{id}', [ProductTypeController::class,'edit']);
Route::post('/update_product_type/{id}', [ProductTypeController::class,'update']);
Route::get('/add_product_type', [ProductTypeController::class,'add']);
Route::post('/create_product_type', [ProductTypeController::class,'create']);


Route::get('/products', [ProductController::class,'index']);
Route::get('/edit_product/{id}', [ProductController::class,'edit']);
Route::post('/update_product/{id}', [ProductController::class,'update']);
Route::get('/add_product', [ProductController::class,'add']);
Route::post('/create_product', [ProductController::class,'create']);


// Route::get('/pallet_types', [PalletTypeController::class,'index']);
// Route::get('/edit_pallet_type/{id}', [PalletTypeController::class,'edit']);
// Route::post('/update_pallet_type/{id}', [PalletTypeController::class,'update']);
// Route::get('/add_pallet_type', [PalletTypeController::class,'add']);
// Route::post('/create_pallet_type', [PalletTypeController::class,'create']);
// Route::post('/delete_pallet_type/{id}', [PalletTypeController::class,'delete']);


Route::get('/view_block/{id}', [BlockController::class,'view']);
Route::get('/edit_block/{id}', [BlockController::class,'edit']);
Route::post('/update_block/{id}', [BlockController::class,'update']);

Route::get('/packings', [PackingController::class,'index']);
Route::get('/view_packing/{id}', [PackingController::class,'view']);
Route::get('/add_packing', [PackingController::class,'add']);
Route::post('/create_packing', [PackingController::class,'create']);
Route::get('/edit_packing/{id}', [PackingController::class,'edit']);
Route::post('/delete_packing/{id}', [PackingController::class,'delete']);
Route::post('/update_packing/{id}', [PackingController::class,'update']);
Route::post('/confirm_packing/{id}', [PackingController::class,'confirm']);
Route::post('/approve_packing/{id}', [PackingController::class,'approve']);
Route::post('/reject_packing/{id}', [PackingController::class,'reject']);
Route::get('/print_packing/{id}', [PackingController::class,'print']);

Route::get('/packing_detail/{id}', [PackingDetailController::class,'index']);
Route::get('/add_packing_detail/{id}', [PackingDetailController::class,'add']);
Route::post('/create_packing_detail/{id}', [PackingDetailController::class,'create']);
Route::get('/edit_packing_detail/{id}', [PackingDetailController::class,'edit']);
Route::post('/update_packing_detail/{id}', [PackingDetailController::class,'update']);
Route::post('/delete_packing_detail/{id}', [PackingDetailController::class,'delete']);
Route::get('/select_rack/{id}', [PackingDetailController::class,'select_rack']);

// Route::get('/select_block/{id}', [PackingDetailController::class,'select_block']); //อันเก่าเเก้ GET เป็น POST
Route::post('/select_block/{id}', [PackingDetailController::class,'select_block']);

Route::post('/select_new_process_pallet/{id}', [PackingDetailController::class,'select_new_process_pallet']);
Route::post('/select_exist_process_pallet/{id}', [PackingDetailController::class,'select_exist_process_pallet']);
Route::get('/stores', [PackingDetailController::class,'stores']);


// Route::post('/select_pallet/{id}', [ProcessPalletController::class,'get_pallet']);

// Route::get('/view_process_pallet/{id}', [ProcessPalletController::class,'view']);


Route::get('/check_outs', [CheckOutController::class,'index']);
Route::get('/add_check_out', [CheckOutController::class,'add']);
Route::post('/create_check_out', [CheckOutController::class,'create']);
Route::get('/edit_check_out/{id}', [CheckOutController::class,'edit']);
Route::post('/update_check_out/{id}', [CheckOutController::class,'update']);
Route::post('/delete_check_out/{id}', [CheckOutController::class,'delete']);
Route::post('/confirm_check_out/{id}', [CheckOutController::class,'confirm']);
Route::post('/approve_check_out/{id}', [CheckOutController::class,'approve']);
Route::post('/reject_check_out/{id}', [CheckOutController::class,'reject']);
Route::get('/print_check_out/{id}', [CheckOutController::class,'print']);


Route::get('/check_out_detail/{id}', [CheckOutDetailController::class,'index']);
Route::get('/select_packing_detail/{id}', [CheckOutDetailController::class,'select_packing_detail']);
Route::post('/assign_check_out_quantity/{id}', [CheckOutDetailController::class,'assign_check_out_quantity']);
Route::post('/create_check_out_detail/{id}', [CheckOutDetailController::class,'create']);
Route::post('/delete_check_out_detail/{id}', [CheckOutDetailController::class,'delete']);


Auth::routes();
