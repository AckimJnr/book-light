<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('index');
});
Route::get('/profile', [AuthController::class, 'user_profile_view'])->name('profile');
Route::post('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'login_view'])->name('login');
Route::get('/register', [AuthController::class, 'register_view'])->name('register');
