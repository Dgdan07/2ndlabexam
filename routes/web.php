<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('tasks.index');
});

Route::get('/', [TaskController::class, 'index']);

Route::resource('tasks', TaskController::class);

