<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    use AuthenticatesUsers;
        public function indexlogin() {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('home')->withSuccess('Signed in');
        }
        return redirect("home")->withSuccess('Login details are not valid');
    }
    public function enterlogin(){
        if (Auth::check()) {
            return view('home');
        }
    return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function signout(){
    Session::flush();
    Auth::logout();
    return Redirect('.auth.login');
    }
}
?>
