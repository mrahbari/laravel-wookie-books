<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', function () {
    abort(422, 'Please login via valid uses or use their tokens in your request');
})->name('login');
//Route::post('login', [ 'as' => 'login', 'uses' => 'LoginController@do']);
