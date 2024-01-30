<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function LoginView()
    {
        return view('login.login');
    }

    public function ProfileView()
    {
        return view('profile.personalProfile');
    }

}
