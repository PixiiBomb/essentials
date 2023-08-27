<?php

use Illuminate\Support\Facades\Route;
use PixiiBomb\Essentials\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Route::group(['middleware' => ['web']], function () { Route::get('/', [HomeController::class, INDEX])->name(HOME); });
|
*/

Route::get('/', [HomeController::class, INDEX])->name(HOME);
