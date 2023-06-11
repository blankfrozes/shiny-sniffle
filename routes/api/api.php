<?php

use Illuminate\Support\Facades\Route;
use Rtphoki\Rtp\Http\Controllers\Api\GameController;
use Rtphoki\Rtp\Http\Controllers\Api\ProviderController;


Route::get('/tournament', 'TournamentController@index')->name('api.tournament');

Route::get('/config', 'ConfigController@index')->name('api.config');

Route::get('/provider', [ProviderController::class,'show'])->name('api.provider');
Route::get('/games/{slug}', [GameController::class,'show'])->name('api.games');