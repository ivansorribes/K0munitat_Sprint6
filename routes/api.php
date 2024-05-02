<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CommunitiesApiController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\commentsPostsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\api\RegisterController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});


Route::get('/communities/{community}/{id_post}', [PostsController::class, 'show'])->middleware('auth:api');

Route::post('/comments', [commentsPostsController::class, 'store']);

Route::post('send/email', [UserController::class, 'mail'])->name('email');
