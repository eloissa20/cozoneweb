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
Route::middleware(['preventBackHistory'])->group(function () {

    Auth::routes();

    Route::middleware(['auth', 'userAuth:1'])->group(function () {

        Route::get('/client_side/home', function () {
            return view('client_side.home_client');
        })->name('client_side.home');

        //details (have id to be follow)
        Route::get('/client_side/details', function () {
            return view('client_side.details_client');
        })->name('client_side.details');

        //payments (have id to be follow)
        Route::get('/client_side/payment/pay', function () {
            return view('client_side.payment.payment_client');
        })->name('client_side.payment');

        Route::get('/client_side/payment/success', function () {
            return view('client_side.payment.payment_success_client');
        })->name('client_side.payment.success');

        //list of spaces
        Route::get('/client_side/lists', function () {
            return view('client_side.lists_client');
        })->name('client_side.lists');

        //how to
        Route::get('/client_side/how/faqs', function () {
            return view('client_side.how_to.faqs_client');
        })->name('client_side.how.faqs');

        Route::get('/client_side/how/find', function () {
            return view('client_side.how_to.find_client');
        })->name('client_side.how.find');

        Route::get('/client_side/how/reserve', function () {
            return view('client_side.how_to.reserve_client');
        })->name('client_side.how.reserve');

        //about
        Route::get('/client_side/about', function () {
            return view('client_side.about_client');
        })->name('client_side.about');

        //profile
        Route::get('/client_side/profile', function () {
            return view('client_side.profile.profile_client');
        })->name('client_side.profile');

        Route::get('/client_side/profile/transactions', function () {
            return view('client_side.profile.transactions_client');
        })->name('client_side.profile.transactions');

        Route::get('/client_side/profile/favorites', function () {
            return view('client_side.profile.favorites_client');
        })->name('client_side.profile.favorites');
    });

    Route::middleware(['auth', 'userAuth:2'])->group(function () {
        Route::get('/coworker_side/coworker', [CoworkerController::class, 'viewDashboard'])->name('coworker_side.coworker');
        Route::get('/coworker_side/listSpace', [CoworkerController::class, 'viewListSpace'])->name('coworker_side.listSpace');
        Route::post('/coworker_side/listSpace', [CoworkerController::class, 'submitListSpace'])->name('listSpace');
        Route::get('/coworker_side/myCoworkingSpace', [CoworkerController::class, 'viewmyCoworkingSpace'])->name('coworker_side.myCoworkingSpace');
        Route::get('/getSpaceDetails/{id}', [CoworkerController::class, 'getSpaceDetails']);
        Route::delete('/deleteSpace/{id}', [CoworkerController::class, 'deleteSpace']);
        Route::post('/updateSpaceDetails', [CoworkerController::class, 'updateSpaceDetails']);
    });


    Route::middleware(['auth', 'userAuth:3'])->group(function () {
        Route::get('/admin_side/admin', [AdminController::class, 'viewDashboard'])->name('admin_side.admin');
    });
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['redirectIfAuthenticated'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
