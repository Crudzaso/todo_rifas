<?php

use App\Http\Controllers\RolerController;
use Illuminate\Support\Facades\Route;

Route::resource('roles',RolerController::class)->names('admin.roles');


