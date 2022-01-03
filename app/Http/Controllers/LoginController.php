<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        return view('public.home.login');
    }

    public function logIn(Request $request)
    {
        $checkLogin = $this->userService->LogIn($request);
        if ($checkLogin) {
            return redirect('/');
        } else {
            return back()->with('error', 'Sai email hoặc mật khẩu');
        }
    }

    public function logOut()
    {
        $this->userService->LogOut();
        return redirect('/');
    }
}
