<?php

use Illuminate\Support\Facades\Route;
use src\Applications\Http\Controllers\GuessingGameController;

Route::group(['middleware' => 'api'], function () {
    Route::post('check', [GuessingGameController::class, 'check']);
    Route::post('stat', [GuessingGameController::class, 'stat']);
});