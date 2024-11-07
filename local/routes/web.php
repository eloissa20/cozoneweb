<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CoworkerController;
use App\Http\Controllers\AdminController;

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
    return view('welcome');
});
Route::middleware(['preventBackHistory'])->group(function() {

    Auth::routes();

    Route::middleware(['auth', 'userAuth:1'])->group(function(){
        Route::get('/client_side/client', [ClientController::class, 'viewClient'])->name('client_side.client');
    });

    Route::middleware(['auth', 'userAuth:2'])->group(function(){
        Route::get('/coworker_side/coworker', [CoworkerController::class, 'viewDashboard'])->name('coworker_side.coworker');
    });

    Route::middleware(['auth', 'userAuth:3'])->group(function(){
        Route::get('/admin_side/admin', [AdminController::class, 'viewDashboard'])->name('admin_side.admin');
    });

});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['redirectIfAuthenticated'])->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});