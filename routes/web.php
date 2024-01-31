<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\PusherController;

// Route::get('/', [PusherController::class, 'index'])->name('home');
// Route::post('/broadcast', [PusherController::class, 'broadcast'])->name('send.message');
// Route::post('/receive', [PusherController::class, 'receive'])->name('recive.message');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/chat', [ChatsController::class, 'index']);
Route::get('/messages', [ChatsController::class, 'fetchMessages']);
Route::post('/messages', [ChatsController::class, 'sendMessage']);
