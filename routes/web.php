<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunitiesController;
use App\Http\Controllers\PostsController;

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

Route::get('/personalProfile', [UserController::class, 'ProfileView'])->name('ProfileView')->middleware('auth');
// Rutas para mostrar vistas
Route::get('/login', [AuthController::class, 'LoginView'])->name('LoginView');
Route::get('/register', [AuthController::class, 'RegisterView'])->name('RegisterView');
Route::view('/privada', 'login.secret')->middleware('auth')->name('privada');
Route::get('/resetPassword', [AuthController::class, 'resetPasswordView'])->name('resetPasswordView');
Route::get('passwordReset/{token}', [AuthController::class, 'resetFormView'])->name('resetFormView');

// Rutas para el proceso de autenticación
Route::post('/inicia-sesion', [AuthController::class, 'login'])->name('inicia-sesion');
Route::post('/validate-register', [AuthController::class, 'register'])->name('validate-register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

Route::get('/adminPanel', function () {
    return view('login.panelAdmin');
});



// Rutas para el olvido y restablecimiento de contraseña
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot.password.link');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('reset.password');

Route::post('/updateProfileDescription', [UserController::class, 'updateProfileDescription'])->name('updateProfileDescription')->middleware('auth');

Route::get('/map', function () {
    return view('map');
});

Route::get('/homepage', function () {
    return view('home-page');
});
Route::get('/form-create-advertisement', [PostsController::class, 'create'])->name('form-create-advertisement');
Route::post('/form-create-advertisement', [PostsController::class, 'store'])->name('form-create-advertisement-post');

Route::get('/community/advertisement-list', function (Illuminate\Http\Request $request) {
    return app(PostsController::class)->index($request, 'advertisement');
})->name('advertisement-list');

Route::get('/community/post-list', function (Illuminate\Http\Request $request) {
    return app(PostsController::class)->index($request, 'post');
})->name('post-list');


Route::get('/paneladminComunitats', [CommunitiesController::class, 'index'])->name('paneladminComunitats');
Route::put('/paneladminComunitats/stateChange/{id}', [CommunitiesController::class, 'stateChange'])->name('stateChange');

Route::get('/paneladminPosts', [PostsController::class, 'getComunnities'])->name('getComunnities');

Route::put('/posts/{post}', [PostsController::class, 'update'])->name('update.post');
