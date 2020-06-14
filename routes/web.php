<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClashesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::view('form', 'home');
Route::post('submit', 'HomeController@save');

Route::get('exambooking','HomeController@search');

Route::post('/home','HomeController@search');

//CRUD implemented routes
Route::resource('/home/clashes','ClashesController');

Route::post('/home/update', 'ClashesController@update')->name('updateclash');