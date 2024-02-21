<?php

use App\Http\Controllers\AcopioController;
use App\Http\Controllers\AddressSendController;
use App\Http\Controllers\ArchivosController;
use App\Http\Controllers\FacturationController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MedicinesController;
use App\Http\Controllers\MedicinesPatientController;
use App\Http\Controllers\MedicineStockAcopioController;
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
        // Facturacion
        Route::prefix('facturacion')->group(function () {
            Route::get('/h/{acopio}',                               [FacturationController::class, 'index'])->name('facturacion.index');
            Route::get('/create/{acopio}',                          [FacturationController::class, 'create'])->name('facturacion.create');
            Route::post('/store',                                   [FacturationController::class, 'store'])->name('facturacion.store');
            Route::get('/edit/{facturacion}',                       [FacturationController::class, 'edit'])->name('facturacion.edit');
            Route::put('/update/{facturacion}',                     [FacturationController::class, 'update'])->name('facturacion.update');
            Route::get('/delete/{facturacion}',                     [FacturationController::class, 'destroy'])->name('facturacion.destroy');
        });
        // Dirección
        Route::prefix('direccion_envio')->group(function () {
            Route::get('/h/{acopio}',                               [AddressSendController::class, 'index'])->name('address_send.index');
            Route::get('/create/{acopio}',                          [AddressSendController::class, 'create'])->name('address_send.create');
            Route::post('/store',                                   [AddressSendController::class, 'store'])->name('address_send.store');
            Route::get('/edit/{address_send}',                      [AddressSendController::class, 'edit'])->name('address_send.edit');
            Route::put('/update/{address_send}',                    [AddressSendController::class, 'update'])->name('address_send.update');
            Route::get('/delete/{address_send}',                    [AddressSendController::class, 'destroy'])->name('address_send.destroy');
        });
        // Archivos
        Route::prefix('archivos')->group(function () {
            Route::get('/h/{acopio}',                               [ArchivosController::class, 'index'])->name('archivos.index');
            Route::get('/create/{acopio}',                          [ArchivosController::class, 'create'])->name('archivos.create');
            Route::post('/store',                                   [ArchivosController::class, 'store'])->name('archivos.store');
            Route::put('/update/{archivo}',                         [ArchivosController::class, 'update'])->name('archivos.update');
            Route::get('/delete/{archivo}',                         [ArchivosController::class, 'destroy'])->name('archivos.destroy');
        });
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

        // Dirección
        Route::prefix('medicamentos')->group(function () {
            Route::get('/create/{patient}',                 [MedicinesPatientController::class, 'create'])->name('medicine_patiente.create');
            Route::post('/store',                           [MedicinesPatientController::class, 'store'])->name('medicine_patiente.store');
            Route::post('/get_box',                         [MedicinesPatientController::class, 'getBox'])->name('medicine_patiente.get_box');
            Route::post('/get_inventario',                  [MedicinesPatientController::class, 'getInventario'])->name('medicine_patiente.get_inventario');
            Route::post('/suspender_medicamento',           [MedicinesPatientController::class, 'suspendeMedicamento'])->name('medicine_patiente.suspendeMedicamento');
            Route::post('/add_price',                       [MedicinesPatientController::class, 'addPrice'])->name('medicine_patiente.add_price');
        });
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
        Route::get('/preview/{order}',                      [OrderController::class, 'preview'])->name('orden.preview');
        Route::post('/change_status_order',                 [OrderController::class, 'change_status_order'])->name('orden.change_status_order');
        Route::post('/change_price',                        [OrderController::class, 'change_price'])->name('orden.change_price');
        Route::post('/add_ticket',                          [OrderController::class, 'addTicket'])->name('orden.add_ticket');
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

    // INVENTARIO
    Route::prefix('inventario')->group(function () {
        Route::get('/',                                     [InventoryController::class, 'index'])->name('inventory.index');
        Route::get('/create',                               [InventoryController::class, 'create'])->name('inventory.create');
        Route::post('/store',                               [InventoryController::class, 'store'])->name('inventory.store');
        Route::get('/edit/{inventory}',                     [InventoryController::class, 'edit'])->name('inventory.edit');
        Route::put('/update/{inventory}',                   [InventoryController::class, 'update'])->name('inventory.update');
        Route::delete('/delete/{inventory}',                [InventoryController::class, 'destroy'])->name('inventory.destroy');
    });
});
