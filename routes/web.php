<?php

use App\Livewire\Counter;
use App\Livewire\TaskManager;
use Illuminate\Support\Facades\Route;

Route::get('/task-manager', TaskManager::class);
Route::get('/counter', Counter::class);

Route::get('/', function () {
    return view('welcome');
});
