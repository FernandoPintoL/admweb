<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntArticuloController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::get('/chat', [MessageController::class, 'index'])->name('chat');
Route::get('/articulo', [IntArticuloController::class, 'index'])->name('articulo');
Route::get('/messages', [MessageController::class, 'messages'])->name('messages');
Route::post('/messagestore', [MessageController::class, 'messagestore'])->name('messagestore');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/notify', [HomeController::class, 'notify'])->name('notify');
Route::get('/notificaciones', [HomeController::class, 'notificaciones'])->name('notificaciones');
Route::post('/markasread', [HomeController::class, 'markasread'])->name('markasread');


Route::get('puzzle', [HomeController::class, 'puzzle']);