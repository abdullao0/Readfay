<?php

use App\Http\Controllers\PassageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

// ========== Profiles ==========
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->middleware('checkUser');;
    Route::post('/profile', [ProfileController::class, 'store']);
    Route::put('/profile/{user_id}', [ProfileController::class, 'update']);
    Route::get('/profile/{user_id}', [ProfileController::class, 'show']);
});

// ========== Passages ==========
    Route::post('/passage', [PassageController::class, 'store']);

Route::middleware(['auth:sanctum', 'checkUser'])->group(function () {
    Route::get('/passage', [PassageController::class, 'index']);
    Route::get('/passage/{passage_id}', [PassageController::class, 'show']);
    Route::put('/passage/{passage_id}', [PassageController::class, 'update']);
    Route::delete('/passage/{passage_id}', [PassageController::class, 'destroy']);

// ========== Questions ==========
    Route::get('/question', [QuestionController::class, 'index']);
    Route::get('/question/{question_id}', [QuestionController::class, 'show']);
    Route::put('/question/{question_id}', [QuestionController::class, 'update']);
});
    Route::post('/question/{passage_id}', [QuestionController::class, 'store']);


// ========== Progress ==========
Route::get('/progress', [ProgressController::class, 'index']);
Route::get('/progress/{question_id}', [ProgressController::class, 'show']);
Route::post('/progress', [ProgressController::class, 'store']);
