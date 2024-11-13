<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RaffleController;
use App\Http\Controllers\RaffleEntrieController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\RolerController;
use Illuminate\Support\Facades\Http;
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


/**
 * raffle routes
*/
//Route::get('/',function (){
//    $response = Http::get('https://api-resultadosloterias.com/api/results');
//    $data = $response->json();
//
//   foreach ($data['data'] as $lottery){
//       echo 'Lotería: ' . $lottery['lottery'] . ' | Resultado: ' . $lottery['result'] . ' | Fecha: ' . $lottery['date'];
//       echo "<br>";
//
//   }
//
//
//});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

<<<<<<< HEAD
Route::get('/auth', function(){
    return view('auth.auth'); //func to load auth view
})-> name('auth');
=======
>>>>>>> 846dd045d5247ca948bfc1d4863ff9c0f187ffbe
