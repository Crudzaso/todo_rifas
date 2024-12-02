<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\MockPaymentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RaffleController;
use App\Http\Controllers\RaffleEntrieController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\RolerController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\winnerController;
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

Route::resource('raffleEntries', RaffleEntrieController::class)->only([
    'store', 'show','index'
]);

Route::get('raffleEntries/{raffleEntry}/payment-simulation', [RaffleEntrieController::class, 'showPaymentSimulation']);

//Route::get('payment/gateway', [PaymentController::class, 'gateway'])->name('payment.gateway');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile/overview', function () {
    return view('profile.overview');
})->name('profile.overview');

Route::get('/login-google', [SocialAuthController::class, 'redirectToGoogle']);
Route::get('/google-callback', [SocialAuthController::class, 'handleGoogleCallback']);

Route::get('/lottery/winner', [winnerController::class, 'showWinner'])->name('lottery.winner');



Route::prefix('payment')->group(function() {

    Route::post('process-simulated-payment/{raffleEntry}', [MockPaymentController::class, 'processSimulatedPayment'])
        ->name('payment.simulation.process');

//     Ruta para mostrar el éxito de la simulación de pago
    Route::get('simulation-success/{raffleEntry}', [MockPaymentController::class, 'simulationSuccess'])
        ->name('payment.simulation.success');

});


//Route::get('raffle-entry/{raffleEntry}/pay', [PaymentController::class, 'pay'])->name('raffleEntry.pay');
//Route::get('mercadopago/success.blade.php/{raffleEntry}', [PaymentController::class, 'success.blade.php'])->name('mercadopago.success.blade.php');
//Route::get('mercadopago/failed/{raffleEntry}', [PaymentController::class, 'failed'])->name('mercadopago.failed');


/**
 * RUTAS DE USUARIOS
*/

Route::get('/users.list', [UsersController::class, 'index'])->name('users.list');
Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
Route::get('/users/archived', [UsersController::class, 'showArchivedUsers'])->name('users.archived');
Route::post('/users/{id}/restore', [UsersController::class, 'restore'])->name('users.restore');




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
