<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RaffleController;
use App\Http\Controllers\RaffleEntrieController;

use App\Http\Controllers\RolerController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\winnerController;
use Illuminate\Support\Facades\Route;


/* rutas del admin*/
Route::resource('roles',RolerController::class)->names('admin.roles');
Route::post('roles/{role}/remove-permissions', [RolerController::class, 'removePermissions'])->name('admin.roles.removePermissions');
Route::get('admin/roles/{roleId}/permissions', [RolerController::class, 'getRolePermissions'])->name('admin.roles.getPermissions');
Route::post('/roles/{role}/add-permissions', [RolerController::class, 'addPermissions'])->name('admin.roles.addPermissions');

/**
 * RUTAS DE USUARIOS
 */

Route::get('/users.list', [UsersController::class, 'index'])->name('users.list');
Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
Route::get('/users/archived', [UsersController::class, 'showArchivedUsers'])->name('users.archived');
Route::post('/users/{id}/restore', [UsersController::class, 'restore'])->name('users.restore');

/* rout raffles
 * **/
Route::resource('raffles', RaffleController::class)->except(['show', 'edit']);

Route::get('/raffles/{raffle}', [RaffleController::class, 'showRaffleEntries'])->name('raffles.show-entries');

Route::post('/raffleEntries', [RaffleEntrieController::class, 'store'])->name('raffleEntries.store');
Route::get('/raffleEntries/{raffleEntry}', [RaffleEntrieController::class, 'succes'])->name('raffleEntries.succes');
Route::get('/raffleEntries/{raffleEntry}', [RaffleEntrieController::class, 'showPayment'])->name('raffleEntries.showPayment');



Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile/overview', function () {
    return view('profile.overview');
})->name('profile.overview');

Route::get('/login-google', [SocialAuthController::class, 'redirectToGoogle']);
Route::get('/google-callback', [SocialAuthController::class, 'handleGoogleCallback']);

Route::get('/lottery/winner', [winnerController::class, 'showWinner'])->name('lottery.winner');

Route::post( '/raffle/{raffleEntryId}/pay', [MercadoPagoController::class, 'createPaymentPreference'])->name('mercadopago.pay');
Route::get('/mercadopago/success/{raffleEntryId}', [MercadoPagoController::class, 'handleSuccess'])->name('mercadopago.success');
Route::get('/mercadopago/failure/{raffleEntryId}', [MercadoPagoController::class, 'handleFailure'])->name('mercadopago.failure');

//Route::post('/payu/create-payment', [PaymentController::class, 'createPayment'])->name('payu.create-payment');
//Route::post('/payu/notification', [PaymentController::class, 'handleNotification'])->name('payu.notification');
//Route::get('/payment/success/{raffleEntry}', [PaymentController::class, 'handlePaymentSuccess'])
//    ->name('payment.success');






Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/auth', function(){
    return view('auth.login'); //func to load auth view
})-> name('auth');

Route::get('/profile', function(){
    return view('User.user-details'); //func to load user details view
})-> name('user-details');

Route::get('/profile/settings',function(){
    return view('User.user-update'); //func to load user edit view
})-> name('user-config');
