<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpleadoController;

Route::get('welcome', function () {
    return view('welcome');
});

Route::get('base', function () {
    return view('base');
});

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::resource('puesto', PuestoController::class);
Route::resource('departamento', DepartamentoController::class);
Route::resource('empleado', EmpleadoController::class);