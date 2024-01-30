<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', [UserController::class, 'LoginView'])->name('LoginView')->middleware('guest');
Route::get('/personalProfile', [UserController::class, 'ProfileView'])->name('ProfileView')->middleware('auth');



Route::get('/login', function () {
    return view('login');
});


