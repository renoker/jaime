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
            'image'                 => 'assets/medicamentos/7502223708440_1.jpg',
            'name'                  => 'LOSARTAN 50 MG',
            'contenido'             => 30,
            'states_medication_id'  => 2
        ]);
    }
}
