<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;
        public function indexlogin() {
        return view('auth.login');
    }
    public function authenticateuser(Request $request)
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
