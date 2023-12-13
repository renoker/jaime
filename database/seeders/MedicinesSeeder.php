<?php

namespace Database\Seeders;

use App\Models\Medicines;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medicines::create([
            'image'             => 'assets/medicamentos/7502223708440_1.jpg',
            'clave'             => 'ABBTT-03',
            'descripcion'       => 'TEOLONG CAP. L.P. 100 MG. CAJA C/20',
            'principal_activo'  => 'TEOFILINA',
            'laboratorio'       => 'ABBOTT',
            'iva'               => 0.16,
            'pecio_maximo'      => 283.00,
            'descuento'         => 60,
            'pecio'             => 113.81,
            'pecio_anterior'    => 280.81,
            'stock'             => 26,
            'comentarios'       => 'Me dicamento en buen estado',
            'caducidad'         => '2023-11-30',
            'codigo_barras'     => '7501285600334'
        ]);

        Medicines::create([
            'image'             => 'assets/medicamentos/7502223708440_1.jpg',
            'clave'             => 'ABBTT-03',
            'descripcion'       => 'TEOLONG CAP. L.P. 100 MG. CAJA C/20',
            'principal_activo'  => 'TEOFILINA',
            'laboratorio'       => 'ABBOTT',
            'iva'               => 0.16,
            'pecio_maximo'      => 283.00,
            'descuento'         => 60,
            'pecio'             => 113.81,
            'pecio_anterior'    => 280.81,
            'stock'             => 20,
            'comentarios'       => 'Me dicamento en buen estado',
            'caducidad'         => '2023-11-30',
            'codigo_barras'     => '7501285600334'
        ]);

        Medicines::create([
            'image'             => 'assets/medicamentos/7502223708440_1.jpg',
            'clave'             => 'ABBTT-03',
            'descripcion'       => 'TEOLONG CAP. L.P. 100 MG. CAJA C/20',
            'principal_activo'  => 'TEOFILINA',
            'laboratorio'       => 'ABBOTT',
            'iva'               => 0.16,
            'pecio_maximo'      => 283.00,
            'descuento'         => 60,
            'pecio'             => 113.81,
            'pecio_anterior'    => 280.81,
            'stock'             => 5,
            'comentarios'       => 'Me dicamento en buen estado',
            'caducidad'         => '2023-11-30',
            'codigo_barras'     => '7501285600334'
        ]);

        Medicines::create([
            'image'             => 'assets/medicamentos/7502223708440_1.jpg',
            'clave'             => 'ABBTT-03',
            'descripcion'       => 'TEOLONG CAP. L.P. 100 MG. CAJA C/20',
            'principal_activo'  => 'TEOFILINA',
            'laboratorio'       => 'ABBOTT',
            'iva'               => 0.16,
            'pecio_maximo'      => 283.00,
            'descuento'         => 60,
            'pecio'             => 113.81,
            'pecio_anterior'    => 280.81,
            'stock'             => 10,
            'comentarios'       => 'Me dicamento en buen estado',
            'caducidad'         => '2023-11-30',
            'codigo_barras'     => '7501285600334'
        ]);

        Medicines::create([
            'image'             => 'assets/medicamentos/7502223708440_1.jpg',
            'clave'             => 'ABBTT-03',
            'descripcion'       => 'TEOLONG CAP. L.P. 100 MG. CAJA C/20',
            'principal_activo'  => 'TEOFILINA',
            'laboratorio'       => 'ABBOTT',
            'iva'               => 0.16,
            'pecio_maximo'      => 283.00,
            'descuento'         => 60,
            'pecio'             => 113.81,
            'pecio_anterior'    => 280.81,
            'stock'             => 120,
            'comentarios'       => 'Me dicamento en buen estado',
            'caducidad'         => '2023-11-30',
            'codigo_barras'     => '7501285600334'
        ]);

        Medicines::create([
            'image'             => 'assets/medicamentos/7502223708440_1.jpg',
            'clave'             => 'ABBTT-03',
            'descripcion'       => 'TEOLONG CAP. L.P. 100 MG. CAJA C/20',
            'principal_activo'  => 'TEOFILINA',
            'laboratorio'       => 'ABBOTT',
            'iva'               => 0.16,
            'pecio_maximo'      => 283.00,
            'descuento'         => 60,
            'pecio'             => 113.81,
            'pecio_anterior'    => 280.81,
            'stock'             => 200,
            'comentarios'       => 'Me dicamento en buen estado',
            'caducidad'         => '2023-11-30',
            'codigo_barras'     => '7501285600334'
        ]);

        Medicines::create([
            'image'             => 'assets/medicamentos/7502223708440_1.jpg',
            'clave'             => 'ABBTT-03',
            'descripcion'       => 'TEOLONG CAP. L.P. 100 MG. CAJA C/20',
            'principal_activo'  => 'TEOFILINA',
            'laboratorio'       => 'ABBOTT',
            'iva'               => 0.16,
            'pecio_maximo'      => 283.00,
            'descuento'         => 60,
            'pecio'             => 113.81,
            'pecio_anterior'    => 280.81,
            'stock'             => 10,
            'comentarios'       => 'Me dicamento en buen estado',
            'caducidad'         => '2023-11-30',
            'codigo_barras'     => '7501285600334'
        ]);
    }
}
