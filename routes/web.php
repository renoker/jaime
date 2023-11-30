<?php

use App\Http\Controllers\MedicinesController;
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
});
