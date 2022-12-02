<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Models\Todo;

Route::middleware('isGuest')->group(function () {
    Route::get('/', [TodoController::class, 'index']);
    Route::get('/register', [TodoController::class, 'register'])->name('register');
    Route::post('/register/input', [TodoController::class, 'registerAccount'])->name('register.input');
    Route::post('/login/auth', [TodoController::class, 'auth'])->name('login.auth');
});

Route::get('/logout', [TodoController::class, 'logout'])->name('logout');

Route::middleware('isLogin')->prefix('/todo')->name('todo.')->group(function () {
    Route::get('/', [TodoController::class, 'home'])->name('index');
    Route::get('/create', [TodoController::class, 'create'])->name('listtodo');
    Route::get('/logout', [TodoController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [TodoController::class, 'dashboard'])->name('dashboard');
    Route::post('/store', [TodoController::class, 'store'])->name('store');
    Route::patch('/update/{id}', [TodoController::class, 'updateCompleted'])->name('updatecompleted');
});
Route::delete('/delete/{id}', [TodoController::class, 'destroy'])->name('destroy');
Route::get('/edit/{id}', [TodoController::class, 'edit'])->name('edit');
Route::patch('/update/{id}', [TodoController::class, 'update'])->name('update');
