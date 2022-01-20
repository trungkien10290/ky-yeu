<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $username = $request->get('email');
        $pass = $request->get('password');

        $connection = new \LdapRecord\Connection([
            'hosts' => [env('LDAP_HOST')],
            'port' => env('LDAP_PORT'),
            'base_dn' => env('LDAP_BASE_DN')
        ]);
        $check = $connection->auth()->attempt($username, $pass);
        if ($check) {
            $user = User::where('email', $username)->first();
            $name = explode('@', $username)[0];
            $name = Str::ucfirst($name);
            if (!$user) {
                User::create([
                    'email' => $username,
                    'password' => bcrypt($pass),
                    'name' => $name
                ]);
            }
            Auth::login($user);
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
