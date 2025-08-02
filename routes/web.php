<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
Route::get('/esqueci', [AuthController::class, 'esqueci'])->name('esqueci');
Route::post('/esqueciSubmit', [AuthController::class, 'esqueciSubmit'])->name('esqueciSubmit');
