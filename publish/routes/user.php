<?php

use Illuminate\Support\Facades\Route;
use PixiiBomb\Essentials\Http\Controllers\UserController;

Route::prefix(USER)->name(USER.'.')->group(function () {
    Route::get(DASHBOARD, [UserController::class, DASHBOARD])->name(DASHBOARD);
    Route::get(LOGOUT, [UserController::class, LOGOUT])->name(LOGOUT);
    Route::get(LOGIN, [UserController::class, LOGIN])->name(LOGIN);
    Route::post(LOGIN, [UserController::class, AUTHENTICATE])->name(AUTHENTICATE);
    Route::get(REGISTER, [UserController::class, REGISTER])->name(REGISTER);
    Route::post(REGISTER, [UserController::class, CREATE])->name(CREATE);
    Route::post('user/update/profile', [UserController::class, 'updateProfile'])->name('update.profile');
});
