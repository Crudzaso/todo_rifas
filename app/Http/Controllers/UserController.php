<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $roles = $user->getRoleNames;
        return view('User.user-details', compact('user', 'roles'));
    }
}
