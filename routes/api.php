<?php

use App\Http\Controllers\TaskController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/getTasks/{id}', [TaskController::class, 'show']);
    Route::get('/getTaskLists', [TaskController::class, 'getTaskLists']);
    Route::get('/getTasks', [TaskController::class, 'getTasks']);
    Route::get('/getLabels', [TaskController::class, 'getLabels']);
    Route::get('/getAssignee', [TaskController::class, 'getAssignee']);
    Route::post('/addNewTask', [TaskController::class, 'addNewTask']);
    Route::post('/addNewTaskList', [TaskController::class, 'addNewTaskList']);
    Route::put('/deleteTaskList', [TaskController::class, 'deleteTaskList']);
    Route::patch('/completeTaskList/{id}', [TaskController::class, 'completeTaskList']);
    Route::patch('/sortTaskList', [TaskController::class, 'sortTaskList']);
});

Route::post('/login', [TaskController::class, 'login']);

