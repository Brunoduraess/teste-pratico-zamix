<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\checkLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
Route::get('/esqueci', [AuthController::class, 'esqueci'])->name('esqueci');
Route::post('/esqueciSubmit', [AuthController::class, 'esqueciSubmit'])->name('esqueciSubmit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(checkLogin::class)->group(function (){
    Route::get('/menu', [AdminController::class, 'menu'])->name('menu');
});
