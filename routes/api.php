<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\LessonsController;
use App\Http\Controllers\LocalAdminController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\UserController;
use App\Models\Timetable;
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

Route::get('/', function () {
    return response()->json(["data" => ['i am alive!', "project" => 'epos-adequate', 'developer' => 'gellyzxc aka Yuriy Safin']]);
});

Route::group(['prefix' => 'v1'], function () {


    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
    });


    Route::group(['middleware' => 'auth:api'], function () {

        Route::group(['prefix' => 'user'], function () {
            Route::group(['prefix' => 'settings'], function () {
                // Route::get('{user}/{action}', []);
                // Route::delete('{user}/{action}', []);
            });
            Route::group(['prefix' => 'info'], function () {
                Route::get('/', [UserController::class, 'info']);
            });
        });

        Route::group(['prefix' => 'pupil'], function () {

            Route::group(['prefix' => 'new'], function () {
                Route::get('school', [SchoolController::class, 'index']);
                Route::get('sub/{schoolClass}', [UserController::class, 'addToClassRequest']);
                Route::get('{school}', [SchoolController::class, 'show']);
            });


            Route::post('timetable/test', [TimetableController::class, 'test']);
            // Route::apiResource('timetable', TimetableController::class)->only(['index', 'show']);
        });

        Route::group(['prefix' => 'stuff'], function () {
            Route::resource('school', SchoolController::class);

            Route::resource('/school/{school}/class', ClassController::class)->parameters([
                'class' => 'schoolClass'
            ]);

            Route::group(['prefix' => 'teacher'], function () {
                Route::group(['prefix' => 'mark'], function () {
                    Route::post('{schoolClass}/{lesson}/{pupil}', [MarksController::class, 'createMark']);
                });

                Route::get('token/renew', [TeacherController::class, 'newToken']);
                Route::group(['prefix' => 'mark'], function () {
                    // Route::get('/{schoolClass}', [MarkController::class, 'getMarks']);
                    // Route::post('/{schoolClass}/{pupil}/{lesson}', [MarkController::class, 'createMark']);
                });

                Route::post('{school}/profile', [TeacherController::class, 'createProfile']);
                Route::delete('profile/{profile}', [TeacherController::class, 'deleteProfile']);
                Route::get('{school}/profile', [TeacherController::class, 'getProfiles']);

                Route::group(['prefix' => 'leader'], function () {
                    Route::get('acceptJoinRequest/{request_id}', [TeacherController::class, 'leaderAccept']);
                    Route::get('denyJoinRequest/{request_id}', [TeacherController::class, 'leaderDeny']);

                    Route::get('{school}/myClass', [TeacherController::class, 'myClass']);
                    Route::get('{school}/myClass/{schoolClass}', [TeacherController::class, 'getPeoplesForMyClass']);

                    Route::group(['prefix' => 'mark'], function () {
                        // Route::get('{class}', []);
                        // Route::get('{class}/{pupil}', []);
                    });
                });
            });

            Route::group(['prefix' => 'local_admin'], function () {
                Route::group(['prefix' => 'timetable'], function () {
                    Route::get('/', [TimetableController::class, 'index']);
                    Route::post('/{schoolClass}', [TimetableController::class, 'store']);
                    Route::get('/{schoolClass}/{timetable}', [TimetableController::class, 'show']);
                    Route::post('/{schoolClass}/{classDayTimetable}/', [LessonsController::class, 'store']);
                });

                Route::get('{school}/teachers', [LocalAdminController::class, 'getTeachers']);
                Route::get('{school}/{teacher}', [LocalAdminController::class, 'addNewLocalAdmin']);
                Route::post('{school}/teacher/{token}', [LocalAdminController::class, 'addNewTeacher']);
                Route::post('{school}/teacher/{schoolTeacher}/leader/{schoolClass}', [LocalAdminController::class, 'makeLeader']);
                // Route::get('{school}/{schoolClass}/pupils', []);
                // Route::get('{school}/{schoolClass}/pupils/{pupil}', []);


            });
        });
    });
});
