<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;


Route::get('/', [MovieController::class, 'index']);
Route::post('/recommend', [MovieController::class, 'recommend'])
    ->name('recommend');
