<?php

use App\Events\PrivateMessage;
use App\Events\PublicMessage;
use Illuminate\Http\Request;
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

Route::get('/chat', function () {
    event(new PublicMessage());
    dd('Public Event Executed sucessfully');
});

Route::get('/private-chat', function () {
    event(new PrivateMessage(auth()->user()));
    dd('Private Event executed succesfully');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
