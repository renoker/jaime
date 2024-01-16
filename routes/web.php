<?php

use App\Http\Controllers\AcopioController;
use App\Http\Controllers\MedicinesController;
use App\Http\Controllers\OrdenMedinaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/perfil', function () {
    return view('pages.perfil');
});

Route::get('/',         [UserController::class, 'login'])->name('user.login');
Route::post('/login',   [UserController::class, 'login_request'])->name('user.login_request');

// Pantallas para usuarios con registro
Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/logout',   [UserController::class, 'logout'])->name('user.logout');
    // USUARIOS
    Route::prefix('usuarios')->group(function () {
        Route::get('/',                                     [UserController::class, 'index'])->name('user.index');
        Route::get('/create',                               [UserController::class, 'create'])->name('user.create');
        Route::post('/store',                               [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{user}',                          [UserController::class, 'edit'])->name('user.edit');
        Route::put('/update/{user}',                        [UserController::class, 'update'])->name('user.update');
        Route::get('/delete/{user}',                        [UserController::class, 'destroy'])->name('user.destroy');
    });
    // CENTRO DE ACOPIO
    Route::prefix('acopio')->group(function () {
        Route::get('/',                                     [AcopioController::class, 'index'])->name('acopio.index');
        Route::get('/create',                               [AcopioController::class, 'create'])->name('acopio.create');
        Route::post('/store',                               [AcopioController::class, 'store'])->name('acopio.store');
        Route::get('/edit/{acopio}',                        [AcopioController::class, 'edit'])->name('acopio.edit');
        Route::put('/update/{acopio}',                      [AcopioController::class, 'update'])->name('acopio.update');
        Route::get('/delete/{acopio}',                      [AcopioController::class, 'destroy'])->name('acopio.destroy');
    });
    // MEDICAMENTOS
    Route::prefix('medicamentos')->group(function () {
        Route::get('/',                                     [MedicinesController::class, 'index'])->name('medicine.index');
        Route::get('/create',                               [MedicinesController::class, 'create'])->name('medicine.create');
        Route::post('/store',                               [MedicinesController::class, 'store'])->name('medicine.store');
        Route::get('/edit/{medicine}',                      [MedicinesController::class, 'edit'])->name('medicine.edit');
        Route::put('/update/{medicine}',                    [MedicinesController::class, 'update'])->name('medicine.update');
        Route::get('/delete/{medicine}',                    [MedicinesController::class, 'destroy'])->name('medicine.destroy');
    });
    // PACIENTES
    Route::prefix('pacientes')->group(function () {
        Route::get('/',                                     [PatientController::class, 'index'])->name('patient.index');
        Route::get('/create',                               [PatientController::class, 'create'])->name('patient.create');
        Route::post('/store',                               [PatientController::class, 'store'])->name('patient.store');
        Route::get('/edit/{patient}',                       [PatientController::class, 'edit'])->name('patient.edit');
        Route::put('/update/{patient}',                     [PatientController::class, 'update'])->name('patient.update');
        Route::get('/delete/{patient}',                     [PatientController::class, 'destroy'])->name('patient.destroy');
        Route::get('/perfil/{patient}',                     [PatientController::class, 'profile'])->name('patient.profile');
    });
    // ORDEN
    Route::prefix('orden')->group(function () {
        Route::get('/',                                     [OrderController::class, 'index'])->name('orden.index');
        Route::get('/create',                               [OrderController::class, 'create'])->name('orden.create');
        Route::post('/store',                               [OrderController::class, 'store'])->name('orden.store');
        Route::get('/edit/{order}',                         [OrderController::class, 'edit'])->name('orden.edit');
        Route::put('/update/{order}',                       [OrderController::class, 'update'])->name('orden.update');
        Route::get('/delete/{order}',                       [OrderController::class, 'destroy'])->name('orden.destroy');
        Route::get('/perfil/{order}',                       [OrderController::class, 'profile'])->name('orden.profile');
    });

    // ORDEN
    Route::prefix('orden_medinas')->group(function () {
        Route::get('/',                                     [OrdenMedinaController::class, 'index'])->name('orden_medinas.index');
        Route::get('/create',                               [OrdenMedinaController::class, 'create'])->name('orden_medinas.create');
        Route::post('/store',                               [OrdenMedinaController::class, 'store'])->name('orden_medinas.store');
        Route::get('/edit/{ordenMedina}',                   [OrdenMedinaController::class, 'edit'])->name('ordenMedina.edit');
        Route::put('/update/{ordenMedina}',                 [OrdenMedinaController::class, 'update'])->name('ordenMedina.update');
        Route::delete('/delete/{ordenMedina}',              [OrdenMedinaController::class, 'destroy'])->name('ordenMedina.destroy');
        Route::get('/perfil/{ordenMedina}',                 [OrdenMedinaController::class, 'profile'])->name('ordenMedina.profile');
        Route::get('/get_orden_medicinas/{order}',          [OrdenMedinaController::class, 'getOrdenMedicina'])->name('ordenMedina.get_orden_medicinas');
    });
});
