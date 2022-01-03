<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserService
{
    public function login($request)
    {
        $user = User::where('email', $request->email)->first();
        if (Hash::check($request->password, $user['password'])) {
            Session::put('user', $user);
            return true;
        }
        return false;
    }

    public function logout()
    {
        Session::remove('user');
    }
}
