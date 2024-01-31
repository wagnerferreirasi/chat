<?php

use App\Http\Controllers\PusherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PusherController::class, 'index'])->name('home');
Route::post('/broadcast', [PusherController::class, 'broadcast'])->name('send.message');
Route::post('/receive', [PusherController::class, 'receive'])->name('recive.message');
