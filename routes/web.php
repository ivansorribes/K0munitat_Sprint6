<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/hola123', function () {
    return view('prova');
});

Route::get('/prova', function () {
    return view ('app');
})
->name('application');

Route::get('/react', function () {
    return view('react');
});

Route::get('/communitiesForm', function () {
    return view('communitiesFormCreate');
});
