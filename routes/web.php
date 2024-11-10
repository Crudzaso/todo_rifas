<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\RaffleController;
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
//Route::post('/raffles', [RaffleController::class, 'store'])->name('raffles.store');
//Route::get('/raffles', [RaffleController::class, 'index'])->name('raffles.index');
//Route::get('/raffles', [RaffleController::class, 'create'])->name('raffles.create');









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

