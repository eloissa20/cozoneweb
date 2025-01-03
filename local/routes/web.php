<?php

use App\Http\Controllers\FilterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransactionController;
use App\Models\Cowork;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CoworkerController;
use App\Http\Controllers\AdminController;
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

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

//the ff is open to all
//home
Route::get('/client_side/home', [FilterController::class, 'client_home'])->name('client_side.home');

//list of spaces
Route::get('/client_side/lists', [FilterController::class, 'client_list'])->name('client_side.lists');

//details
Route::get('/client_side/details/{id}', [ClientController::class, 'show_cowork_details'])->name('client_side.details');

//how to
Route::get('/client_side/how/faqs', function () {
    return view('client_side.how_to.faqs_client');
})->name('client_side.how.faqs');

Route::get('/client_side/how/find', function () {
    return view('client_side.how_to.find_client');
})->name('client_side.how.find');

Route::get('/client_side/how/reserve', function () {
    $coworkingSpaces = Cowork::orderBy('created_at', 'desc')->get();

    return view('client_side.how_to.reserve_client', compact('coworkingSpaces'));
})->name('client_side.how.reserve');

//about
Route::get('/client_side/about', function () {
    return view('client_side.about_client');
})->name('client_side.about');

Route::middleware(['preventBackHistory'])->group(function () {

    Auth::routes();

    Route::middleware(['auth', 'userAuth:1'])->group(function () {
        //details

        Route::post('/client_side/details/reserve/{id}', [TransactionController::class, 'processReservation'])->name('client_side.details.reserve');
        Route::get('/client_side/reservation/{id}', [TransactionController::class, 'viewReservation'])->name('client_side.reservation.details');

        //reviews
        Route::post('/client_side/reviews/add/{spaceId}', [ReviewController::class, 'store'])->name('client_side.review.add');
        Route::put('/client_side/reviews/update/{id}', [ReviewController::class, 'update'])->name('client_side.review.update');
        Route::delete('/client_side/reviews/delete/{id}', [ReviewController::class, 'destroy'])->name('client_side.review.delete');

        //reply
        Route::post('/client_side/reply/add/{spaceId}', [ReviewController::class, 'add_reply'])->name('client_side.reply.add');

        //payment
        Route::get('/client_side/payment/pay/{id}/{transactionId}', [PaymentController::class, 'client_payment'])->name('client_side.payment');
        Route::get('/client_side/payment/cancel/{spaceId}/{transactionId}', [PaymentController::class, 'cancelPayment'])->name('client_side.payment.cancel');
        Route::post('/client_side/payment/process/{id}/{transactionId}', [TransactionController::class, 'paymentProcess'])->name('client_side.payment.process');
        Route::get('/client_side/payment/success', [PaymentController::class, 'client_payment_success_page'])->name('client_side.payment.page.success');
        // payment success and failed
        Route::get('/client_side/payment/success/{id}/{transactionId}/{paymentMethod}/{amount}', [PaymentController::class, 'paymentSuccess'])->name('client_side.payment.success');
        Route::get('/client_side/payment/failed', [PaymentController::class, 'paymentFailed'])->name('client_side.payment.failed');

        //contact cozone
        Route::post('/client_side/about/contact', [ClientController::class, 'send_email'])->name('client_side.about.contact');

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

        Route::get('/coworker_side/addDesks/{id}', [CoworkerController::class, 'addDesks'])->name('addDesks');
        // Route::post('/coworker_side/addDesks/{id}', [CoworkerController::class, 'saveDesks'])->name('saveDesks');
        // Route::delete('/coworker_side/deleteDesk/{id}', [CoworkerController::class, 'deleteDesk'])->name('deleteDesk');
        Route::post('/coworker_side/addDesks/{id}', [CoworkerController::class, 'saveDesks'])->name('saveDesks');
        Route::delete('/coworker_side/deleteDesk/{id}', [CoworkerController::class, 'deleteDesk'])->name('deleteDesk');
        Route::post('/coworker_side/edit-desk/{id}', [CoworkerController::class, 'editDesk'])->name('editDesk');





        Route::get('/coworker_side/addMeetings/{id}', [CoworkerController::class, 'addMeetings'])->name('addMeetings');
        Route::post('/coworker_side/addMeetings/{id}', [CoworkerController::class, 'saveMeetings'])->name('saveMeetings');
        Route::delete('/coworker_side/deleteMeeting/{id}', [CoworkerController::class, 'deleteMeeting'])->name('deleteMeeting');
        Route::post('/coworker_side/editMeeting/{id}', [CoworkerController::class, 'editMeeting'])->name('editMeeting');


        Route::post('/coworker_side/listSpace', [CoworkerController::class, 'submitListSpace'])->name('listSpace');

        Route::get('/coworker_side/myCoworkingSpace', [CoworkerController::class, 'viewmyCoworkingSpace'])->name('myCoworkingSpace');

        Route::get('/coworker_side/reviews', [CoworkerController::class, 'viewReviews'])->name('reviews');
        Route::post('/coworker_side/reviews/{reviewId}/reply', [CoworkerController::class, 'replyToReview'])->name('coworker_side.replyToReview');
        Route::get('/coworker_side/reviews/filter', [CoworkerController::class, 'filterReviews'])->name('reviews.filter');


        Route::get('/coworker_side/reservations', [CoworkerController::class, 'viewReservations'])->name('reservations');
        Route::post('/coworker_side/update-status', [CoworkerController::class, 'updateStatus'])->name('updateStatus');


        Route::get('/coworker_side/viewSpaceDetails/{id}', [CoworkerController::class, 'viewSpaceDetails'])->name('viewSpaceDetails');

        Route::delete('/coworker_side/deleteSpace/{id}', [CoworkerController::class, 'deleteSpace'])->name('deleteSpace');

        Route::get('/coworker_side/editSpace/{id}', [CoworkerController::class, 'editSpace'])->name('editSpace');

        Route::put('/coworker_side/editSpace/{id}', [CoworkerController::class, 'updateSpace'])->name('coworker_side.updateSpace');

        Route::get('/coworker_side/about_us', [CoworkerController::class, 'aboutUs'])->name('aboutUs');

        Route::get('/export-transactions', function () {
            return Excel::download(new TransactionsExport, 'transactions.xlsx');
        });
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
