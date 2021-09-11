<?php

use Illuminate\Support\Facades\Route;
use src\Applications\Http\Controllers\PatternCheckerController;

Route::group(['middleware' => 'api'], function () {
    Route::get('check', [PatternCheckerController::class, 'check']);
    Route::get('stat', [PatternCheckerController::class, 'stat']);
});