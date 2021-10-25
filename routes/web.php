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

// Route::get('/send_mail','mailController@sendMail');


Auth::routes();

Route::group(['middleware'=>'auth'],function(){
    
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/getData','testController@getData');
Route::get('/delArticle/{id}','testController@delArticle');
Route::get('/getArticle/{id}','testController@getArticle');
Route::post('/updateArticle','testController@updateArticle');
});


