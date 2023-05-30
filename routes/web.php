<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\quejasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [quejasController::class, 'index'])->name('dashboard');
});

Route::post("/registrar-queja", [quejasController::class, "create"])->name("quejas.create");
Route::post("/modificar-queja", [quejasController::class, "update"])->name("quejas.update");
Route::put('/quejas/{idqueja}/actualizar-estado', [quejasController::class,"actualizarEstado"])->name('actualizar.estado');
Route::put('/quejas/{idqueja}/descartar-estado', [quejasController::class,"descartarEstado"])->name('descartar.estado');