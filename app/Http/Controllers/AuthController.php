<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login()
    {
        $assign['hideHeader'] = 1;
        $assign['hideFooter'] = 1;
        return view('public.home.login', $assign);
    }

    public function submitLogin(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);
        } catch (\Throwable $exception) {
            return redirect()->back()->withErrors(['error' => __('public.required data')]);
        }
        $credentials = [
            'uid' => $request->get('username'),
            'password' => $request->get('password'),
        ];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect(route('home.index'));
        } else {
            return redirect()->back()->withErrors(['error' => __('public.auth.failed')]);
        }
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->logout();
        }
        return redirect(route('home.index'));
    }
}
