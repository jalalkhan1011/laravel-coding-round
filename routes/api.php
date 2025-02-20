<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//post controller
Route::get('posts', [PostController::class, 'index']);
Route::post('posts', [PostController::class, 'store']);
Route::get('posts/{id}', [PostController::class, 'show']);
Route::put('posts/{id}', [PostController::class, 'update']);
Route::delete('posts/{id}', [PostController::class, 'destroy']);

//register controller
Route::post('register', [RegisterController::class, 'register']);

//task controller 
Route::get('tasks', [TaskController::class, 'index']);
Route::get('tasks/pending', [TaskController::class, 'pendingTask']);
Route::post('tasks', [TaskController::class, 'store']);
Route::get('tasks/{id}', [TaskController::class, 'show']);
Route::put('tasks/{id}', [TaskController::class, 'update']); 
Route::delete('tasks/{id}', [TaskController::class, 'destroy']);


