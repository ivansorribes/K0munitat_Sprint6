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
use App\Models\communitiesUsers;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\commentsPostsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;



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
})->name('AdminPanel');

// USER RELATED
Route::get('/personalProfile', [UserController::class, 'ProfileView'])->name('ProfileView')->middleware('auth');
Route::post('/updateProfileDescription', [UserController::class, 'updateProfileDescription'])->name('updateProfileDescription')->middleware('auth');
Route::get('/login', [AuthController::class, 'LoginView'])->name('LoginView');
Route::get('/register', [AuthController::class, 'RegisterView'])->name('RegisterView');
Route::view('/privada', 'login.secret')->middleware('auth')->name('privada');
Route::get('/resetPassword', [AuthController::class, 'resetPasswordView'])->name('resetPasswordView');
Route::get('passwordReset/{token}', [AuthController::class, 'resetFormView'])->name('resetFormView');
Route::get('/editPersonalProfile', [UserController::class, 'EditProfileView'])->name('EditProfileView')->middleware('auth');
Route::post('/updateUserInfo', [UserController::class, 'updateUserInfo'])->name('updateUserInfo')->middleware('auth');
Route::post('/changePassword', [UserController::class, 'changePassword'])->name('changePassword')->middleware('auth');
Route::post('/deleteUserImage', [UserController::class, 'deleteUserImage'])->name('deleteUserImage')->middleware('auth');

//Contact
Route::get('/contact', [ContactController::class, 'contactView'])->name('contact.view')->middleware('auth');
//Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// FORGOT PASSWORD / PASSWORD-RESET
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot.password.link');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('reset.password');

// AUTH
Route::post('/inicia-sesion', [AuthController::class, 'login'])->name('inicia-sesion');
Route::post('/validate-register', [AuthController::class, 'register'])->name('validate-register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
//FACEBOOK AUTH
Route::get('/auth/redirect', [AuthController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/callback', [AuthController::class, 'callback'])->name('auth.callback');
//GOOGLE AUTH
Route::get('/auth/Redirect1', [AuthController::class, 'Redirect1'])->name('auth.redirect1');
Route::get('/auth/Callback1', [AuthController::class, 'Callback1'])->name('auth.callback1');

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

Route::middleware('allowAccesDates')->group(function () {
    Route::get('/communitiesUserActual', [CommunitiesController::class, 'userActual'])->name('communities.userActual');
    Route::get('/communitiesList', [CommunitiesController::class, 'communitiesList'])->name('communities.list');
    Route::get('/communitiesUser', [CommunitiesController::class, 'communitiesUser'])->name('communities.user');
    Route::get('/communitiesOpen', [CommunitiesController::class, 'communitiesOpen'])->name('communities.open');
    Route::get('/communitiesUserId', [CommunitiesController::class, 'communitiesUserId'])->name('communities.userId');
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


Route::get('/dashboard', function () {
    return view('adminPanel.dashboard');
})->name('dashboard');


// Rutas protegidas por el middleware CheckRole

Route::get('/paneladminComunitats', [CommunitiesController::class, 'retornarComunitats'])->name('paneladminComunitats');
Route::put('/paneladminComunitats/stateChange/{id}', [CommunitiesController::class, 'stateChange'])->name('stateChange');
Route::match(['put', 'get'], '/paneladminComunitats/showUsers/{id}', [CommunitiesController::class, 'showUsers'])->name('showUsers');
Route::put('/user/{id}/community/{id_community}', [UserController::class, 'delUserFromCommunity'])->name('delUserFromCommunity');

Route::get('/paneladminPosts', [PostsController::class, 'getPosts'])->name('paneladminPosts');
Route::put('/posts/{post}/toggle', [PostsController::class, 'toggleActivation'])->name('posts.toggle');
Route::get('/posts/{post}', [PostsController::class, 'showPostById'])->name('post.show');
Route::put('/posts/edit/{post}', [PostsController::class, 'updatePost'])->name('update.post');

Route::get('/paneladminUsers', [UserController::class, 'userInfo'])->name('paneladminUsers');
Route::post('/users/{id}/toggleIsActive', [UserController::class, 'toggleIsActive'])->name('users.toggleIsActive');
Route::get('/users/{id}/detail', [UserController::class, 'showDetail'])->name('users.detail');
Route::put('/users/{id}', [UserController::class, 'update'])->name('updateUser');
Route::post('/users', [UserController::class, 'store'])->name('storeUser');
Route::get('/createUserForm', function () {
    return view('adminPanel.createUserForm');
})->name('createUserForm');

Route::get('/paneladminAdvertisements', [PostsController::class, 'getAdvertisements'])->name('paneladminAdvertisements');
Route::put('/advertisements/{advertisement}', [PostsController::class, 'updateAdvertisement'])->name('update.advertisement');

Route::post('/login', [AuthController::class, 'authenticate'])->name('login');



Route::get('/loginAdmin', function () {
    return view('adminPanel.loginAdmin');
})->name('loginAdmin');


////EVENTS
Route::get('/events', function () {
    return view('events.calendar');
})->name('calendar');

Route::middleware('allowAccesDates')->get('/eventsList', [EventController::class, 'index'])->name('events.list');
Route::middleware('checkSuperAdmin')->post('/eventsList', [EventController::class, 'store'])->name('events.store');

// BLOG
Route::get('/blog', [BlogController::class, 'index'])->name('blog');


Route::get('/admin', function () {
    return view('panelAdmin');
})->name('admin');

Route::get('/paneladmin', function () {
    return view('panel-admin');
})->name('panel-admin');




//Header
//Header


Route::post('/posts/{post}/likes', [LikeController::class, 'like'])->middleware('auth');

Route::put('/comments/{editingCommentId}', [commentsPostsController::class, 'edit']);
Route::delete('/comments/{commentId}', [commentsPostsController::class, 'destroy']);
Route::put('/posts/{id_post}', [PostsController::class, 'update']);
