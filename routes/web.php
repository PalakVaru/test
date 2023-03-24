<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('guest')->group(function() {
    Route::get('register', [RegisterController::class, 'getRegister'])->name('registration');
    Route::get('/', [LoginController::class, 'getLogin'])->name('user_login');
    Route::post('registration', [RegisterController::class, 'register'])->name('register');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});


Route::middleware('auth')->group(function() {
    Route::get('index', [UserController::class, 'index'])->name('index');
    Route::post('delete', [UserController::class, 'destroy'])->name('delete');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

});


