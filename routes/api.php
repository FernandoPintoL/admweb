<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\IntArticuloController;
use App\Http\Controllers\IntArticuloCodBarraController;
use App\Http\Controllers\IntExistenciaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/existenick', [UserController::class, 'existeNick'])->name('existenick');
Route::post('/existeemail', [UserController::class, 'existeEmail'])->name('existeemail');
Route::post('/getuser', [UserController::class, 'getUser'])->name('getuser');
// ARTICULO //
Route::post('/articulo/register', [IntArticuloController::class, 'store']);
Route::post('/articulo/update', [IntArticuloController::class, 'update']);
Route::post('/articulo/query', [IntArticuloController::class, 'getQueryArticulo']);
Route::post('/articulo/show', [IntArticuloController::class, 'show']);
/// ARTICULO COD BARRA //
Route::post('/articulo/register/codbarra', [IntArticuloCodBarraController::class, 'store']);
Route::post('/articulo/update/codbarra', [IntArticuloCodBarraController::class, 'update']);
Route::post('/articulo/codbarra', [IntArticuloCodBarraController::class, 'getArticuloCodBarra']);
Route::post('/articulo/codbarras', [IntArticuloCodBarraController::class, 'getArticulosCodsBarras']);
// ARTICULO EXISTENCIA //
Route::post('/articulo/register/existencia', [IntExistenciaController::class, 'store']);
Route::post('/articulo/update/existencia', [IntExistenciaController::class, 'update']);
Route::post('/articulo/existencia', [IntExistenciaController::class, 'getExistencia'])->name('existencia');
