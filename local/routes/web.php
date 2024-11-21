<?php

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransactionController;
use App\Models\Cowork;
use App\Models\Favorites;
use App\Models\Transactions;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CoworkerController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;

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
    return view('auth.login');
});

Route::middleware(['preventBackHistory'])->group(function () {

    Auth::routes();

    Route::middleware(['auth', 'userAuth:1'])->group(function () {

        Route::get('/client_side/home', function (Request $request) {
            $query = Cowork::query();

            if ($request->has('search')) {
                $query->where('coworking_space_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('coworking_space_address', 'LIKE', '%' . $request->search . '%');
            }

            $spaces = $query->paginate(6);

            $user = Auth::user();
            $favoritedSpaceIds = [];

            if ($user) {
                $favoritedSpaceIds = Favorites::where('user_id', $user->id)->pluck('space_id')->toArray();
            }

            foreach ($spaces as $space) {
                $space->isFavorite = in_array($space->id, $favoritedSpaceIds);
            }

            return view('client_side.home_client', ['spaces' => $spaces]);
        })->name('client_side.home');

        //details
        Route::post('/client_side/details/{id}', [ClientController::class, 'show_cowork_details'])->name('client_side.details');
        Route::post('/client_side/details/reserve/{id}', [TransactionController::class, 'processReservation'])->name('client_side.details.reserve');


        //reviews
        Route::post('/client_side/reviews/add/{spaceId}', [ReviewController::class, 'store'])->name('client_side.review.add');
        Route::put('/client_side/reviews/update/{id}', [ReviewController::class, 'update'])->name('client_side.review.update');
        Route::delete('/client_side/reviews/delete/{id}', [ReviewController::class, 'destroy'])->name('client_side.review.delete');

        //payment
        Route::get('/client_side/payment/pay/{id}/{transactionId}', function ($id, $transactionId) {
            $space = Cowork::find($id);
            if (!$space) {
                return abort(404, 'Space not found');
            }

            $transaction = Transactions::find($transactionId);
            if(!$transaction){
                return abort( 404, 'Transaction not found');
            }
            return view('client_side.payment.payment_client', ['space' => $space, 'transaction' => $transaction]);
        })->name('client_side.payment');

        Route::get('/client_side/payment/success/{id}', function ($id) {
            $space = Cowork::find($id);
            if (!$space) {
                return abort(404, 'Space not found');
            }
            return view('client_side.payment.payment_success_client', ['space' => $space]);
        })->name('client_side.payment.success');

        //list of spaces
        Route::get('/client_side/lists', function (Request $request) {
            $query = Cowork::query();

            if ($request->has('search')) {
                $query->where('coworking_space_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('coworking_space_address', 'LIKE', '%' . $request->search . '%');
            }

            $spaces = $query->paginate(6);

            $user = Auth::user();
            $favoritedSpaceIds = [];

            if ($user) {
                $favoritedSpaceIds = Favorites::where('user_id', $user->id)->pluck('space_id')->toArray();
            }

            foreach ($spaces as $space) {
                $space->isFavorite = in_array($space->id, $favoritedSpaceIds);
            }
            return view('client_side.lists_client', ['spaces' => $spaces]);
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
            $favorites = auth()->user()->user_favorites()->with('cowork')->get(); //how can i access the cowork attributes

            return view('client_side.profile.favorites_client', ['favorites' => $favorites,]);
        })->name('client_side.profile.favorites');


    });

    Route::middleware(['auth', 'userAuth:2'])->group(function () {

        Route::get('/coworker_side/coworker', [CoworkerController::class, 'viewDashboard'])->name('coworker_side.coworker');

        Route::get('/coworker_side/listSpace', [CoworkerController::class, 'viewListSpace'])->name('coworker_side.listSpace');

        Route::post('/coworker_side/listSpace', [CoworkerController::class, 'submitListSpace'])->name('listSpace');

        Route::get('/coworker_side/myCoworkingSpace', [CoworkerController::class, 'viewmyCoworkingSpace'])->name('myCoworkingSpace');

        Route::get('/coworker_side/reviews', [CoworkerController::class, 'viewReviews'])->name('reviews');

        Route::get('/coworker_side/reservations', [CoworkerController::class, 'viewReservations'])->name('reservations');

        Route::get('/coworker_side/viewSpaceDetails/{id}', [CoworkerController::class, 'viewSpaceDetails'])->name('viewSpaceDetails');
        
        Route::delete('/coworker_side/deleteSpace/{id}', [CoworkerController::class, 'deleteSpace'])->name('deleteSpace');

    });

    Route::middleware(['auth', 'userAuth:3'])->group(function () {
        Route::get('/admin_side/admin', [AdminController::class, 'viewDashboard'])->name('admin_side.admin');
    });

});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['redirectIfAuthenticated'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});