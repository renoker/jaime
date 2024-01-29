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
            'clave'             => 'ABBTT-01',
            'descripcion'       => 'TEOLONG01 CAP. L.P. 100 MG. CAJA C/20',
            'principal_activo'  => 'TEOFILINA',
            'laboratorio'       => 'ABBOTT',
            'iva'               => 0.16,
            'pecio_maximo'      => 283.00,
            'descuento'         => 60,
            'pecio'             => 933.81,
            'pecio_anterior'    => 280.81,
            'stock'             => 26,
            'contenido'         => 30,
            'comentarios'       => 'Me dicamento en buen estado',
            'caducidad'         => '2023-11-30',
            'codigo_barras'     => '7501285600334'
        ]);

        Medicines::create([
            'image'             => 'assets/medicamentos/7502223708440_1.jpg',
            'clave'             => 'ABBTT-02',
            'descripcion'       => 'TEOLONG02 CAP. L.P. 100 MG. CAJA C/20',
            'principal_activo'  => 'TEOFILINA',
            'laboratorio'       => 'ABBOTT',
            'iva'               => 0.16,
            'pecio_maximo'      => 283.00,
            'descuento'         => 60,
            'pecio'             => 813.81,
            'pecio_anterior'    => 280.81,
            'stock'             => 20,
            'contenido'         => 30,
            'comentarios'       => 'Me dicamento en buen estado',
            'caducidad'         => '2023-11-30',
            'codigo_barras'     => '7501285600334'
        ]);

        Medicines::create([
            'image'             => 'assets/medicamentos/7502223708440_1.jpg',
            'clave'             => 'ABBTT-03',
            'descripcion'       => 'TEOLONG03 CAP. L.P. 100 MG. CAJA C/20',
            'principal_activo'  => 'TEOFILINA',
            'laboratorio'       => 'ABBOTT',
            'iva'               => 0.16,
            'pecio_maximo'      => 283.00,
            'descuento'         => 60,
            'pecio'             => 613.81,
            'pecio_anterior'    => 280.81,
            'stock'             => 5,
            'contenido'         => 1,
            'comentarios'       => 'Me dicamento en buen estado',
            'caducidad'         => '2023-11-30',
            'codigo_barras'     => '7501285600334'
        ]);

        Medicines::create([
            'image'             => 'assets/medicamentos/7502223708440_1.jpg',
            'clave'             => 'ABBTT-04',
            'descripcion'       => 'TEOLONG04 CAP. L.P. 100 MG. CAJA C/20',
            'principal_activo'  => 'TEOFILINA',
            'laboratorio'       => 'ABBOTT',
            'iva'               => 0.16,
            'pecio_maximo'      => 283.00,
            'descuento'         => 60,
            'pecio'             => 313.81,
            'pecio_anterior'    => 280.81,
            'stock'             => 10,
            'contenido'         => 10,
            'comentarios'       => 'Me dicamento en buen estado',
            'caducidad'         => '2023-11-30',
            'codigo_barras'     => '7501285600334'
        ]);

        Medicines::create([
            'image'             => 'assets/medicamentos/7502223708440_1.jpg',
            'clave'             => 'ABBTT-05',
            'descripcion'       => 'TEOLONG05 CAP. L.P. 100 MG. CAJA C/20',
            'principal_activo'  => 'TEOFILINA',
            'laboratorio'       => 'ABBOTT',
            'iva'               => 0.16,
            'pecio_maximo'      => 283.00,
            'descuento'         => 60,
            'pecio'             => 543.81,
            'pecio_anterior'    => 280.81,
            'stock'             => 120,
            'contenido'         => 20,
            'comentarios'       => 'Me dicamento en buen estado',
            'caducidad'         => '2023-11-30',
            'codigo_barras'     => '7501285600334'
        ]);

        Medicines::create([
            'image'             => 'assets/medicamentos/7502223708440_1.jpg',
            'clave'             => 'ABBTT-06',
            'descripcion'       => 'TEOLONG06 CAP. L.P. 100 MG. CAJA C/20',
            'principal_activo'  => 'TEOFILINA',
            'laboratorio'       => 'ABBOTT',
            'iva'               => 0.16,
            'pecio_maximo'      => 283.00,
            'descuento'         => 60,
            'pecio'             => 13.81,
            'pecio_anterior'    => 280.81,
            'stock'             => 200,
            'contenido'         => 10,
            'comentarios'       => 'Me dicamento en buen estado',
            'caducidad'         => '2023-11-30',
            'codigo_barras'     => '7501285600334'
        ]);

        Medicines::create([
            'image'             => 'assets/medicamentos/7502223708440_1.jpg',
            'clave'             => 'ABBTT-07',
            'descripcion'       => 'TEOLONG07 CAP. L.P. 100 MG. CAJA C/20',
            'principal_activo'  => 'TEOFILINA',
            'laboratorio'       => 'ABBOTT',
            'iva'               => 0.16,
            'pecio_maximo'      => 283.00,
            'descuento'         => 60,
            'pecio'             => 113.81,
            'pecio_anterior'    => 280.81,
            'stock'             => 10,
            'contenido'         => 10,
            'comentarios'       => 'Me dicamento en buen estado',
            'caducidad'         => '2023-11-30',
            'codigo_barras'     => '7501285600334'
        ]);
    }
}
