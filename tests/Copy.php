<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        // Retrieve Input
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // If successful login
            // Custom logic goes here
            return redirect('home');
        }

        // If failed login
        return redirect('login');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }
}

?>


if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
endif

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

// batas

public function index()
{
    return view('auth.login');
}
public function customLogin(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        return redirect()->intended('dashboard')
            ->withSuccess('Signed in');
    }
    return redirect("login")->withSuccess('Login details are not valid');
}
public function registration()
{
    return view('auth.register');
}
public function customRegistration(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);
    $data = $request->all();
    $check = $this->create($data);
    return redirect("dashboard")->withSuccess('You have signed-in');
}
public function create(array $data)
{
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
    ]);
}
public function dashboard()
{
    if (Auth::check()) {
        return view('auth.dashboard');
    }
    return redirect("login")->withSuccess('You are not allowed to access');
}
public function signOut()
{
    Session::flush();
    Auth::logout();
    return Redirect('login');
}
