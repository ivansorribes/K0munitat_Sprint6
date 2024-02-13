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

//Rutas de comunidades
Route::get('/comuAut/list', [AutonomousCommunitiesController::class, 'list'])->name('comuAut.list');
Route::get('/comuAut/regList/{AutCom}', [AutonomousCommunitiesController::class, 'regionList'])->name('comuAut.regList');

Route::get('/communities', [CommunitiesController::class, 'index'])->name('communities.index');
Route::get('/communities/{community}', [CommunitiesController::class, 'show'])->name('communities.show');
Route::get('/communities/create', [CommunitiesController::class, 'create'])->name('communities.create');
Route::post('/communities', [CommunitiesController::class, 'store']);
Route::get('/communities/{community}/edit', [CommunitiesController::class, 'edit'])->name('communities.edit');
Route::put('/communities/{community}', [CommunitiesController::class, 'update']);
Route::delete('/communities/{community}', [CommunitiesController::class, 'destroy']);

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

Route::get('/', function () {
    return view('home-page');
});
Route::get('/form-create-advertisement', [PostsController::class, 'create'])->name('form-create-advertisement');
Route::post('/form-create-advertisement', [PostsController::class, 'store'])->name('form-create-advertisement-post');

Route::get('/community/{communityId}/advertisement-list', function (Request $request, $communityId) {
    return app(PostsController::class)->index($request, $communityId, 'advertisement');
})->name('advertisement-list');

Route::get('/community/{communityId}/post-list', function (Request $request, $communityId) {
    return app(PostsController::class)->index($request, $communityId, 'post');
})->name('post-list');
