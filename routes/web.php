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
use App\Http\Controllers\BlogController;
use App\Models\communitiesUsers;
use App\Http\Controllers\LikePostController;
use App\Http\Controllers\commentsPostsController;
use App\Http\Controllers\CommunityRequestController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\LikeCommentController;
use App\Http\Controllers\ReplyCommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikeReplyCommentController;

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
    return view('adminPanel.loginAdmin');
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
Route::post('/sendEmail', [ContactController::class, 'store'])->name('contact.store');
Route::get('/getUserInfo',  [ContactController::class, 'getUser'])->name('getUser')->middleware('auth');


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
    Route::post('/communitiesRequest', [CommunityRequestController::class, 'store'])->name('communitiesRequest.store');

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
})->name('advertisements-posts.show')->middleware('auth');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/user-count-by-month', [UserController::class, 'userCountByMonth']);
Route::get('/post-count-by-category', [PostsController::class, 'postCountByCategory']);

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
Route::delete('/users/{id}/destroy', [UserController::class, 'destroy'])->name('deleteUser');

Route::get('/createUserForm', function () {
    return view('adminPanel.createUserForm');
})->name('createUserForm');

Route::get('/paneladminAdvertisements', [PostsController::class, 'getAdvertisements'])->name('paneladminAdvertisements');
Route::put('/advertisements/{advertisement}', [PostsController::class, 'updateAdvertisement'])->name('update.advertisement');

Route::post('/login', [AuthController::class, 'authenticate'])->name('login');

//Rutes para el email part de admin/usuari
Route::get('/paneladminEmail', [MessagesController::class, 'getEmailView'])->name('getEmailView');
Route::post('/messages/{id}', [MessagesController::class, 'destroy'])->name('delete.message');
Route::post('/messagesRestoreAdmin/{id}', [MessagesController::class, 'restoreAdmin'])->name('restoreAdmin.message');
Route::post('/reply-message', [MessagesController::class, 'replyMessage'])->name('reply.message');
Route::get('/emailUser', [MessagesController::class, 'emailUserView'])->name('emailUserView');
Route::post('/messagesDelete/{id}', [MessagesController::class, 'Delete'])->name('eliminate.message');
Route::post('/messagesRestore/{id}', [MessagesController::class, 'restore'])->name('restore.message');
Route::post('/reply-message-2', [MessagesController::class, 'replyMessageClient'])->name('reply.message2');





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

Route::get('/blog/show/{id}', [BlogController::class, 'viewCard'])->name('blog.show');

Route::get('/paneladminBlog', [BlogController::class, 'adminPanel'])->name('paneladminBlog');

Route::get('/blog/create', [BlogController::class, 'createBlog'])->name('blog.create');

Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');

Route::delete('/blog/destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');

Route::get('/blog/{id}/edit', [BlogController::class, 'updateBlog'])->name('blog.edit');

Route::match(['put', 'patch'], '/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');


Route::get('/admin', function () {
    return view('panelAdmin');
})->name('admin');

Route::get('/paneladmin', function () {
    return view('panel-admin');
})->name('panel-admin');


Route::post('/posts/{post}/likes', [LikePostController::class, 'like'])->middleware('auth');
Route::put('/comments/{editingCommentId}', [commentsPostsController::class, 'edit'])->middleware('auth');
Route::delete('/comments/{commentId}', [commentsPostsController::class, 'destroy'])->middleware('auth');
Route::post('/comments/{commentId}/likes', [LikeCommentController::class, 'like'])->middleware('auth');
Route::put('/posts/{id_post}', [PostsController::class, 'update'])->middleware('auth');
Route::post('/comments/{commentId}/reply', [ReplyCommentController::class, 'store'])->middleware('auth');
Route::post('/replies/{replyId}/likes', [LikeReplyCommentController::class, 'likeReply'])->middleware('auth');
Route::put('/replies/{replyId}', [ReplyCommentController::class, 'update'])->middleware('auth');
Route::delete('/replies/{replyId}', [ReplyCommentController::class, 'destroy'])->middleware('auth');
