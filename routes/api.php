<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Units\UnitController;
use App\Http\Controllers\Courses\CoursesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'middleware' => 'api'
], function ($router) {
    
    /**
     * Authentication Module
     */
    Route::group(['prefix' => 'auth'], function() {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });
    
 

    /**
     * Courses Module
     */
    Route::resource('courses', CoursesController::class);
    Route::get('courses/view/all', [CoursesController::class, 'indexAll']);
    Route::get('courses/view/search', [CoursesController::class, 'search']);

    /**
     * Units Module
     */

    Route::resource('units', UnitController::class);
    Route::get('units/view/all', [UnitController::class, 'indexAll']);
    Route::get('units/view/search', [UnitController::class, 'search']);


});

