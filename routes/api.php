<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SchoolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});


Route::group(['middleware' => 'auth:api', 'prefix' => 'v1'], function () {
    Route::group(['prefix' => 'pupil'], function () {
        Route::resource('school', SchoolController::class);

        Route::group(['prefix' => 'class'], function () {
            Route::resource('/{school}', ClassController::class)->parameters([
                '{school}' => 'optional?'
            ]);
        });

        Route::group(['prefix' => 'mark'], function () {

        });
    });

    Route::group(['prefix' => 'teacher'], function () {
        Route::group(['prefix' => 'school'], function () {

        });

        Route::group(['prefix' => 'class'], function () {

        });

        Route::group(['prefix' => 'mark'], function () {

        });
    });
});
