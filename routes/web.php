<?php

use App\Livewire\TaskManager;
use Illuminate\Support\Facades\Route;

Route::get('/task-manager', TaskManager::class);

Route::get('/', function () {
    return view('welcome');
});
