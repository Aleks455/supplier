<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;

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


Route::get('/', [SupplierController::class, 'index'])->name('home'); 

Route::get('/store', [SupplierController::class, 'store'])->name('suppliers.store'); 

Route::post('/supplier/delete', [SupplierController::class, 'destroy'])->name('supplier.destroy'); 

Route::get('/suppliers', [SupplierController::class, 'showAll'])->name('suppliers.all');

Route::get('/supplier/{supplier:id}', [SupplierController::class, 'edit'])->name('supplier.edit'); 

Route::post('/supplier/update', [SupplierController::class, 'update'])->name('supplier.update'); 





