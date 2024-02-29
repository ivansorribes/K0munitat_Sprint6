<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CommunitiesApiController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\commentsPostsController;

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

Route::get('/communities', [CommunitiesApiController::class, 'index'])->name('api.communities.index');
Route::get('/communities/{community}', [CommunitiesApiController::class, 'show'])->name('api.communities.show');

Route::get('/events', [EventController::class, 'index'])->name('api.events.index');
Route::post('/events', [EventController::class, 'store'])->name('api.events.store');

Route::get('/communities/{community}/{id_post}', [PostsController::class, 'show']);

Route::post('/comments', [commentsPostsController::class, 'store']);

Route::post('/posts/{post}/likes', [PostsController::class, 'like'])->middleware('auth');
Route::delete('/posts/{post}/likes', [PostsController::class, 'unlike'])->middleware('auth');
