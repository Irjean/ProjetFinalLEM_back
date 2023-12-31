<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
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

Route::get('/questions', [QuestionController::class, "getQuestions"]);

Route::post("/login", [UserController::class, "login"]);

Route::get("/answers/{id}", [AnswerController::class, "getOneAnswer"]);

Route::get("/answer/all", [AnswerController::class, "getallAnswers"]);

Route::post('/answer', [AnswerController::class, 'postAnswers']);
