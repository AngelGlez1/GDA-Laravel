<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\RegionController;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login')
    ->with('info', 'Welcome!');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('customers', CustomerController::class);
Route::resource('communes', CommuneController::class);
Route::resource('regions', RegionController::class);

Route::get('trashed/customers', [App\Http\Controllers\CustomerController::class, 'trashed'])->name('customers.trashed');
Route::post('customers/{customer}', [App\Http\Controllers\CustomerController::class, 'restore'])->withTrashed()->name('customers.restore');

Route::get('customers/getcommuner', [App\Http\Controllers\CustomerController::class, 'getcommuner'])->name('getcommuner');

