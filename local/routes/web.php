<?php

use App\Http\Controllers\FilterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransactionController;
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
    return view('landing');
})->name('landing');

Route::middleware(['preventBackHistory'])->group(function () {

    Auth::routes();

    Route::middleware(['auth', 'userAuth:1'])->group(function () {
        //home
        Route::get('/client_side/home', [FilterController::class, 'client_home'])->name('client_side.home');

        //details
        Route::get('/client_side/details/{id}', [ClientController::class, 'show_cowork_details'])->name('client_side.details');
        Route::post('/client_side/details/reserve/{id}', [TransactionController::class, 'processReservation'])->name('client_side.details.reserve');

        //reviews
        Route::post('/client_side/reviews/add/{spaceId}', [ReviewController::class, 'store'])->name('client_side.review.add');
        Route::put('/client_side/reviews/update/{id}', [ReviewController::class, 'update'])->name('client_side.review.update');
        Route::delete('/client_side/reviews/delete/{id}', [ReviewController::class, 'destroy'])->name('client_side.review.delete');

        //payment
        Route::get('/client_side/payment/pay/{id}/{transactionId}', [PaymentController::class, 'client_payment'])->name('client_side.payment');
        Route::post('/client_side/payment/process/{id}/{transactionId}', [TransactionController::class, 'paymentProcess'])->name('client_side.payment.process');
        Route::get('/client_side/payment/success/{id}/{transactionId}', [PaymentController::class, 'client_payment_success'])->name('client_side.payment.success');

        //list of spaces
        Route::get('/client_side/lists', [FilterController::class, 'client_list'])->name('client_side.lists');

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
            return view('client_side.profile.profile_client', ['user' => auth()->user()]);
        })->name('client_side.profile');

        Route::get('/client_side/profile/transactions', function () {
            return view('client_side.profile.transactions_client');
        })->name('client_side.profile.transactions');

        Route::get('/client_side/profile/transactions/data', [ClientController::class, 'transaction_table'])->name('client_side.profile.transactions.data');

        Route::put('/client_side/profile/update/{user}', [ClientController::class, 'profile_update'])->name('client_side.profile.update');

        Route::delete('/client_side/profile/favorite/remove', [ClientController::class, 'remove_favorite'])->name('client_side.profile.favorite.remove');

        Route::delete('/client_side/profile/favorite/remove/space', [ClientController::class, 'remove_favorite_by_space'])->name('client_side.profile.favorite.remove.space');

        Route::post('/client_side/profile/favorite/add', [ClientController::class, 'add_to_favorite'])->name('client_side.profile.favorite.add');

        Route::get('/client_side/profile/favorites', function () {
            $favorites = auth()->user()
                ->user_favorites()
                ->with('cowork')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('client_side.profile.favorites_client', ['favorites' => $favorites]);
        })->name('client_side.profile.favorites');

        //notifications
        Route::get('/client_side/notifications/all', [NotificationController::class, 'showAll'])->name('client_side.notifications.all');
    });

    Route::middleware(['auth', 'userAuth:2'])->group(function () {

        Route::get('/coworker_side/coworker', [CoworkerController::class, 'viewDashboard'])->name('coworker_side.coworker');
        Route::get('/count-free-pass', [CoworkerController::class, 'countFreePass'])->name('countFreePass');
        Route::get('/reservation-transactions', [CoworkerController::class, 'showReservationTransactions'])->name('reservationTransactions');
        Route::get('/reservation-type-counts', [CoworkerController::class, 'getReservationTypeCounts']);
        Route::get('/daily-sales-chart-data', [CoworkerController::class, 'dailySalesChartData']);


        Route::get('/coworker_side/listSpace', [CoworkerController::class, 'viewListSpace'])->name('coworker_side.listSpace');

        Route::post('/coworker_side/listSpace', [CoworkerController::class, 'submitListSpace'])->name('listSpace');

        Route::get('/coworker_side/myCoworkingSpace', [CoworkerController::class, 'viewmyCoworkingSpace'])->name('myCoworkingSpace');

        Route::get('/coworker_side/reviews', [CoworkerController::class, 'viewReviews'])->name('reviews');

        Route::get('/coworker_side/reservations', [CoworkerController::class, 'viewReservations'])->name('reservations');

        Route::get('/coworker_side/viewSpaceDetails/{id}', [CoworkerController::class, 'viewSpaceDetails'])->name('viewSpaceDetails');

        Route::delete('/coworker_side/deleteSpace/{id}', [CoworkerController::class, 'deleteSpace'])->name('deleteSpace');

        Route::get('/coworker_side/editSpace/{id}', [CoworkerController::class, 'editSpace'])->name('editSpace');

        Route::put('/coworker_side/editSpace/{id}', [CoworkerController::class, 'updateSpace'])->name('coworker_side.updateSpace');
    });

    Route::middleware(['auth', 'userAuth:3'])->group(function () {
        Route::get('/admin_side/admin', [AdminController::class, 'viewDashboard'])->name('admin_side.admin');

        Route::get('/admin_side/users', [AdminController::class, 'viewUsers'])->name('users');
        Route::get('/admin_side/users/create', [AdminController::class, 'createUser'])->name('user.create');
        Route::post('/admin_side/users', [AdminController::class, 'storeUser'])->name('user.store');
        Route::get('/admin_side/users/{id}/edit', [AdminController::class, 'editUser'])->name('user.edit');
        Route::put('/admin_side/users/{id}/update', [AdminController::class, 'updateUser'])->name('user.update');
        Route::post('/admin_side/users/{id}/deactivate', [AdminController::class, 'deactivateUser'])->name('user.deactivate');
        Route::get('/admin_side/viewUserDetails/{id}', [AdminController::class, 'viewUserDetails'])->name('viewUserDetails');

        Route::get('/admin_side/deactivated_users', [AdminController::class, 'viewDeactivatedUsers'])->name('deactivated');
        Route::post('/admin_side/reactivate/{id}', [AdminController::class, 'reactivateUser'])->name('user.reactivate');
        Route::delete('/admin_side/deactivated_users/{id}', [AdminController::class, 'deleteUser'])->name('deactivated.delete');


        Route::get('/admin_side/clients', [AdminController::class, 'viewClients'])->name('clients');

        Route::get('/admin_side/spaces', [AdminController::class, 'viewSpaces'])->name('admin.spaces');
        Route::get('/admin_side/viewSpaceDetails/{id}', [AdminController::class, 'viewSpaceDetails'])->name('viewSpaceDetails');

        Route::get('/admin_side/transactions', [AdminController::class, 'viewTransactions'])->name('admin.transactions');
        Route::get('/admin_side/viewTransactionDetails/{id}', [AdminController::class, 'viewTransactionDetails'])->name('viewTransactionDetails');
    });
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['redirectIfAuthenticated'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
