<?php

use Illuminate\Support\Facades\Route;
use PixiiBomb\Essentials\Http\Controllers\HomeController;
use PixiiBomb\Essentials\Http\Controllers\UserController;


Route::group(['middleware' => ['web']], function () {

    Route::get('/', [HomeController::class, INDEX])->name(HOME);

});
