<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RaffleController;
use App\Http\Controllers\RaffleEntrieController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\RolerController;
use App\Http\Controllers\UserController;
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


Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
