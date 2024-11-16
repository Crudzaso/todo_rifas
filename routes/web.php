<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RaffleController;
use App\Http\Controllers\RaffleEntrieController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\RolerController;
use Illuminate\Support\Facades\Route;


/* rutas del admin*/
Route::resource('roles',RolerController::class)->names('admin.roles');
Route::post('roles/{role}/remove-permissions', [RolerController::class, 'removePermissions'])->name('admin.roles.removePermissions');
Route::get('admin/roles/{roleId}/permissions', [RolerController::class, 'getRolePermissions'])->name('admin.roles.getPermissions');
Route::post('/roles/{role}/add-permissions', [RolerController::class, 'addPermissions'])->name('admin.roles.addPermissions');

/* rout raffles
 * **/
Route::resource('raffles', RaffleController::class);

/* rout result lotery
 * **/
Route::get('/results', [ResultController::class, 'index']);


Route::resource('raffleEntries',RaffleEntrieController::class);
Route::get('payment/gateway', [PaymentController::class, 'gateway'])->name('payment.gateway');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile/overview', function () {
    return view('profile.overview');
})->name('profile.overview');

Route::get('/login-google', [SocialAuthController::class, 'redirectToGoogle']);
Route::get('/google-callback', [SocialAuthController::class, 'handleGoogleCallback']);


Route::get('raffle-entry/{raffleEntry}/pay', [PaymentController::class, 'pay'])->name('raffleEntry.pay');
Route::get('mercadopago/success/{raffleEntry}', [PaymentController::class, 'success'])->name('mercadopago.success');
Route::get('mercadopago/failed/{raffleEntry}', [PaymentController::class, 'failed'])->name('mercadopago.failed');



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
