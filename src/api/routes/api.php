<?php

use Illuminate\Support\Facades\Route;
use src\Applications\Http\Controllers\PatternCheckerController;

Route::group(['middleware' => 'api'], function () {
    Route::post('check', [PatternCheckerController::class, 'check']);
    Route::post('stat', [PatternCheckerController::class, 'stat']);
});