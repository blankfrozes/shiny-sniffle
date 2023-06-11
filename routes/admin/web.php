<?php

use Illuminate\Support\Facades\Route;


Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');

Route::get('/profile', 'AdminController@profile')->name('profile');

Route::get('/config', 'AdminController@config')->name('config');