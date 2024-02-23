<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunitiesController;
use App\Http\Controllers\autonomousCommunitiesController;
use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\BlogController;

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

// HOMEPAGE
Route::get('/', function () {
    return view('home-page');
})->name('home');

// ABOUT US
Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

// ADMIN PANEL
Route::get('/adminPanel', function () {
    return view('login.panelAdmin');
});

// USER RELATED
Route::get('/personalProfile', [UserController::class, 'ProfileView'])->name('ProfileView')->middleware('auth');
Route::post('/updateProfileDescription', [UserController::class, 'updateProfileDescription'])->name('updateProfileDescription')->middleware('auth');
Route::get('/login', [AuthController::class, 'LoginView'])->name('LoginView');
Route::get('/register', [AuthController::class, 'RegisterView'])->name('RegisterView');
Route::view('/privada', 'login.secret')->middleware('auth')->name('privada');
Route::get('/resetPassword', [AuthController::class, 'resetPasswordView'])->name('resetPasswordView');
Route::get('passwordReset/{token}', [AuthController::class, 'resetFormView'])->name('resetFormView');

// FORGOT PASSWORD / PASSWORD-RESET
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot.password.link');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('reset.password');

// AUTH
Route::post('/inicia-sesion', [AuthController::class, 'login'])->name('inicia-sesion');
Route::post('/validate-register', [AuthController::class, 'register'])->name('validate-register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    //Rutas de comunidades
    Route::get('/comuAut/list', [AutonomousCommunitiesController::class, 'list'])->name('comuAut.list');
    Route::get('/comuAut/regList/{AutCom}', [AutonomousCommunitiesController::class, 'regionList'])->name('comuAut.regList');

    Route::get('/communities/create', [CommunitiesController::class, 'create'])->name('communities.create');
    Route::get('/communities', [CommunitiesController::class, 'index'])->name('communities.index');

    // Show community with posts & ads
    Route::get('/communities/{community}', [PostsController::class, 'index'])->name('communities.show');
    Route::post('/communities', [CommunitiesController::class, 'store']);
    Route::get('/communities/{community}/edit', [CommunitiesController::class, 'edit'])->name('communities.edit');
    Route::put('/communities/{community}', [CommunitiesController::class, 'update']);
    Route::delete('/communities/{community}', [CommunitiesController::class, 'destroy']);
});

// Rutas para el olvido y restablecimiento de contraseña
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot.password.link');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('reset.password');

Route::post('/updateProfileDescription', [UserController::class, 'updateProfileDescription'])->name('updateProfileDescription')->middleware('auth');
Route::get('/postUser', [UserController::class, 'postUser'])->name('postUser')->middleware('auth');
Route::get('/CommentsUser/{id_post}', [UserController::class, 'CommentsUser'])->name('CommentsUser')->middleware('auth');
Route::post('/updatePost/{id_post}', [UserController::class, 'EditPost'])->name('EditPost')->middleware('auth');
Route::post('/deletePost/{id_post}', [UserController::class, 'DeletePost'])->name('deletePost')->middleware('auth');

//Header

// POSTS - ADVERTISEMENTS
Route::get('/communities/{community}/form-create-advertisement-post', [PostsController::class, 'createPost'])->name('advertisements-posts.form-create-advertisement-post');
Route::post('/communities/{community}/form-create-advertisement-post', [PostsController::class, 'store'])->name('form-create-advertisement-post-post');
// Route::get('/communities/{community}/{id_post}', [PostsController::class, 'show'])->name('advertisements-posts.show');
Route::get('/communities/{community}/{id_post}', function () {
    return view('advertisements-posts.show');
})->name('advertisements-posts.show');

Route::get('/paneladminComunitats', [CommunitiesController::class, 'retornarComunitats'])->name('paneladminComunitats');
Route::put('/paneladminComunitats/stateChange/{id}', [CommunitiesController::class, 'stateChange'])->name('stateChange');

Route::get('/paneladminPosts', [PostsController::class, 'getComunnities'])->name('getComunnities');
Route::put('/posts/{post}', [PostsController::class, 'update'])->name('update.post');

Route::get('/paneladminUsers', [UserController::class, 'userInfo'])->name('paneladminUsers');
Route::put('/users/{id}/toggleIsActive', [UserController::class, 'toggleIsActive'])->name('toggleIsActive');
Route::put('/users/{id}', [UserController::class, 'update'])->name('updateUser');

Route::get('/events', function () {
    return view('events.calendar');
})->name('calendar');
// BLOG
Route::get('/blog', [BlogController::class, 'index'])->name('blog');

//Header
