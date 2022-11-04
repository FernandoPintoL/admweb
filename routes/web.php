<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntArticuloController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TipoUsuarioController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
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

    Route::prefix('admin')->name('admin.')->middleware(['role:admin'])->group(function(){
        Route::prefix('articulo')->name('articulo.')->group(function(){
            Route::get('/', [IntArticuloController::class, 'index'])->name('index');
            Route::get('/create', [IntArticuloController::class, 'create'])->name('create');
            Route::post('/', [IntArticuloController::class, 'store'])->name('store');
            Route::get('/{articulo}/edit', [IntArticuloController::class, 'edit'])->name('edit');
            Route::put('/{articulo}', [IntArticuloController::class, 'update'])->name('update');
            Route::get('/{articulo}/delete', [IntArticuloController::class, 'destroy'])->name('destroy');
        });
    });
    //USUARIO
    Route::resource('user', UserController::class);

    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/{id}', [UserController::class, 'edit'])->name('usuarios.edit');
    //TIPO DE USUARIOS
    Route::resource('tipouser', TipoUsuarioController::class);

    // ROLES
    Route::get('/roles/permisos', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');

    //PERMISOS
    Route::get('/permisos', [PermissionController::class, 'index'])->name('permiso.index');

    //ARTICULO
    Route::get('/articulo', [IntArticuloController::class, 'index'])->name('articulo');
});


/*
Route::get('/chat', [MessageController::class, 'index'])->name('chat');
Route::get('/messages', [MessageController::class, 'messages'])->name('messages');
Route::post('/messagestore', [MessageController::class, 'messagestore'])->name('messagestore');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/notify', [HomeController::class, 'notify'])->name('notify');
Route::get('/notificaciones', [HomeController::class, 'notificaciones'])->name('notificaciones');
Route::post('/markasread', [HomeController::class, 'markasread'])->name('markasread');


Route::get('puzzle', [HomeController::class, 'puzzle']);*/
