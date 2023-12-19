<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function view() {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        // Retrieve Input
        $credentials = $request->only('username', 'password');
        // Validate Credentials
        if (Auth::attempt($credentials)){
            // If successful login
            // Custom logic goes here
            return redirect()->route('home');
        }
        // If failed login
        // return redirect('auth.login');
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
}
?>
