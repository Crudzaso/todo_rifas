<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\IssuerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RaffleController;
use App\Http\Controllers\RaffleEntrieController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\RolerController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use MercadoPago\MercadoPagoConfig;


/* rutas del admin*/
Route::resource('roles',RolerController::class)->names('admin.roles');
Route::post('roles/{role}/remove-permissions', [RolerController::class, 'removePermissions'])->name('admin.roles.removePermissions');
Route::get('admin/roles/{roleId}/permissions', [RolerController::class, 'getRolePermissions'])->name('admin.roles.getPermissions');
Route::post('/roles/{role}/add-permissions', [RolerController::class, 'addPermissions'])->name('admin.roles.addPermissions');

/* rout raffles
 * **/
Route::resource('raffles', RaffleController::class);


Route::resource('raffleEntries',RaffleEntrieController::class);
Route::get('/winners', [RaffleController::class, 'showWinners'])->name('winners');


Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [RaffleController::class, 'showLandingPage']);


Route::get('/profile/overview', function () {
    return view('profile.overview');
})->name('profile.overview');

Route::get('/login-google', [SocialAuthController::class, 'redirectToGoogle']);
Route::get('/google-callback', [SocialAuthController::class, 'handleGoogleCallback']);



//Route::get('/test-mercadopago', function () {
//    MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
//
//    return response()->json([
//        'access_token' => config('services.mercadopago.access_token'),
//        'configured_token' => MercadoPagoConfig::getAccessToken(),
//    ]);
//});



Route::get('/payment/gateway/{entry}', [PaymentController::class, 'index'])->name('payment.gateway');
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('payment.process');



// En routes/web.php o routes/api.php
Route::get('/get-issuers/{id}', [IssuerController::class, 'getIssuers']);


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
    return view('auth.auth'); //func to load auth view
})-> name('auth');
