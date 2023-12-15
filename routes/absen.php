<?php

use App\Http\Controllers\Absen\TelegramHandleController;
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


Route::any('/', [TelegramHandleController::class, 'handle'])->name('bot-handle');
Route::any('/webhook', [TelegramHandleController::class, 'setWebHook']);
Route::any('/update', [TelegramHandleController::class, 'update']);
Route::any('/dell', [TelegramHandleController::class, 'dell']);
Route::any('/update', [TelegramHandleController::class, 'getUpdate']);
