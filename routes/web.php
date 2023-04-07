<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LotController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['as' => 'user.','prefix' => 'auction'], function() {
    Route::resource('lots', LotController::class);
    Route::resource('categories', CategoryController::class);
});

