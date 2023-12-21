<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function indexlogin() {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'datetoday' => Carbon::now()
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
    // public function signout(){
    // Session::flush();
    // Auth::logout();
    // return Redirect('.auth.login');
    //}
}
?>
