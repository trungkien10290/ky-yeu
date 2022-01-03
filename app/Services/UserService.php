<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class UserService
{
    public function login($request)
    {



        return view('public.home.index');
    }

    public function logout()
    {
        \auth()->logout();
    }
}
