<?php

use App\Http\Controllers\Auth\AuthController; 
use App\Http\Controllers\Units\UnitController;
use App\Http\Controllers\Courses\CoursesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Admin\AdminController; 
use App\Http\Controllers\Lesson\LessonController;
use App\Http\Controllers\Exercise\ExerciseController;

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
     * Admin Module
     */
    Route::group(['prefix' => 'admin'], function() {
        Route::post('register', [AdminController::class, 'register']);
        Route::post('login', [AdminController::class, 'login']);
        Route::post('logout', [AdminController::class, 'logout']);
        Route::post('refresh', [AdminController::class, 'refresh']);
        Route::get('me', [AdminController::class, 'me']);
        
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

     /**
     * Lesson Module
     */ 
    Route::resource('lessons', LessonController::class);
    Route::get('lessons/view/all', [LessonController::class, 'indexAll']); 
    Route::get('lessons/view/search', [LessonController::class, 'search']);
    Route::get('lessons/by-course/{course_id}', [LessonController::class,'getLessonByUnitID']);


    /**
     * Exercise Module
     */ 
    
    Route::resource('exercises', ExerciseController::class);
    Route::get('exercises/view/all', [ExerciseController::class, 'indexAll']);
    Route::post('exercises/create', [ExerciseController::class, 'store']) ;
    Route::get('exercises/view/search', [ExerciseController::class, 'search']);
    Route::get('exercises/by-lesson/{course_id}/{unit_id}/{lesson_id}', [ExerciseController::class,'getExercisesByLessonID']);


});

