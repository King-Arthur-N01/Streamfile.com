<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Auth\LoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/login', function () { return view('login');});
Route::get('/login', [LoginController::class ,'showLoginForm']);

Route::post('/login', [LoginController::class , 'authenticate'])->name('pushlogin');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

