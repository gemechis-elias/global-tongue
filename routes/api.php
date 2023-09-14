<?php

use App\Http\Controllers\Auth\AuthController; 
use App\Http\Controllers\Units\UnitController;
use App\Http\Controllers\A1Courses\CoursesController;
use App\Http\Controllers\Payment\PaymentController;

use App\Http\Controllers\Levels\LevelsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Admin\AdminController; 
use App\Http\Controllers\Lesson\LessonController;
use App\Http\Controllers\Progress\ProgressController;

use App\Http\Controllers\Exercise\ExerciseController;
use App\Http\Controllers\Tips\TipsController;
use App\Http\Controllers\Conversation\ConversationController;


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
    Route::get('courses/view/search', [CoursesController::class, 'search']);
    Route::get('courses/{id}', [CoursesController::class,'show']); 

    // Payment Module
 
    Route::resource('payments', PaymentController::class);
    Route::get('payments/view/all', [PaymentController::class, 'indexAll']);
    Route::get('payments/{id}', [PaymentController::class,'show']);

    /**
     * Levels Module
     */
    Route::resource('levels',LevelsController::class);
    Route::get('levels/by/{course_id}', [LevelsController::class,'getLevelsByCourseID']);
    Route::get('levels/view/search', [LevelsController::class, 'search']);
    Route::get('levels/{id}', [LevelsController::class,'show']); 
    /**
     * Progress Module
     */
    Route::resource('progress',ProgressController::class);
    Route::get('progress/{user_id}', [ProgressController::class,'show']);

    
    /**
     * Units Module
     */

    Route::resource('units', UnitController::class);
    Route::get('units/view/all', [UnitController::class, 'indexAll']);
    Route::get('units/by/{course_id}/{level_id}', [UnitController::class,'getUnitsByCourseID']);


     /**
     * Lesson Module
     */ 
    Route::resource('lessons', LessonController::class); 
    Route::get('lessons/by/{course_id}/{level_id}/{unit_id}', [LessonController::class,'getLessonsByUnitID']);
    Route::get('lessons/getContent/{lesson_id}', [LessonController::class,'getContent']);
 



    /**
     * Exercise Module
     */ 
    
    Route::resource('exercises', ExerciseController::class); 
    Route::get('exercises/by/{course_id}/{level_id}/{unit_id}/{lesson_id}', [ExerciseController::class,'getExercisesByLessonID']);

        /**
     * Tip Module
     */ 
    
    Route::resource('tips', TipsController::class);
    Route::get('tips/view/all', [TipsController::class, 'indexAll']); 
    Route::get('tips/by/{course_id}/{level_id}/{unit_id}/{lesson_id}', [TipsController::class,'getTipsByLessonID']);
 
 
    /**
     * Conversation Module
     */ 
    Route::resource('conversations', ConversationController::class);
    Route::get('conversations/view/search', [ConversationController::class, 'search']);
    Route::get('conversations/by/{course_id}/{level_id}/{unit_id}/{lesson_id}', [ConversationController::class,'getConversationsByLessonID']);


});

