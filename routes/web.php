<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('/admin', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
