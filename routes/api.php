<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatroomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AuthController;


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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('chatroom/create', [ChatroomController::class, 'create']);
    Route::get('chatroom/list', [ChatroomController::class, 'list']);
    Route::post('chatroom/enter', [ChatroomController::class, 'enter']);
    Route::post('chatroom/leave', [ChatroomController::class, 'leave']);
    Route::post('message/send', [MessageController::class, 'send']);
    Route::get('message/list', [MessageController::class, 'list']);
});
