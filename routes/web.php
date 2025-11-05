<?php

use Illuminate\Support\Facades\Route;




use App\Http\Controllers\PassageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;


Route::get('/',[PassageController::class,'index']);
Route::get('/index',[PassageController::class,'index'])->name('index');

Route::get('/login', function () {
    return view('templates.login');
});
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/register', function () {
    return view('templates.register');
});

Route::post('/register', [UserController::class, 'register'])->name('register');

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

// ========== Profiles ==========
// Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::middleware('auth:sanctum')->group(function () {


Route::get('/profile', function () {
    return view('templates.createProfile');})->name('profile');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');  


Route::get('/updateProfile/{user_id}',[ProfileController::class,'editProfile'])->name('updateProfile'); 
Route::put('/profile/{user_id}', [ProfileController::class, 'update'])->name('profile.update');


Route::get('/profile/{user_id}', [ProfileController::class, 'show'])->name('profile.get');
Route::get('/passage', [PassageController::class, 'index']);
Route::get('/passage/{passage_id}', [PassageController::class, 'show'])->name('show.passage');
Route::get('/question/{passage_id}', [QuestionController::class, 'show'])->name('questions.show');
Route::post('/progress', [ProgressController::class, 'store'])->name('store.progress');


Route::get('/progress', [ProgressController::class, 'index']);
Route::get('/progress/{question_id}', [ProgressController::class, 'show']);
});







Route::middleware(['auth:sanctum', 'checkUser'])->group(function () {
    Route::post('/passage', [PassageController::class, 'store']);
    Route::put('/passage/{passage_id}', [PassageController::class, 'update']);
    Route::delete('/passage/{passage_id}', [PassageController::class, 'destroy']);
    Route::get('/question', [QuestionController::class, 'index']);
    Route::post('/question/{passage_id}', [QuestionController::class, 'store']);
    Route::put('/question/{question_id}', [QuestionController::class, 'update']);
});
