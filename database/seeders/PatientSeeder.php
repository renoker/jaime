<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::create([
            'acopio_id' => 1,
            'image'     => 'assets/pacientes/descarga.jpeg',
            'name'      => 'Rodolfo Ramirez',
            'edad'      => '30'
        ]);

        Patient::create([
            'acopio_id' => 1,
            'image'     => 'assets/pacientes/descarga.jpeg',
            'name'      => 'Daniel Rosiles',
            'edad'      => '30'
        ]);

        Patient::create([
            'acopio_id' => 1,
            'image'     => 'assets/pacientes/descarga.jpeg',
            'name'      => 'Gerardo Canceco',
            'edad'      => '30'
        ]);

        Patient::create([
            'acopio_id' => 1,
            'image'     => 'assets/pacientes/descarga.jpeg',
            'name'      => 'Giovanni Aranda',
            'edad'      => '30'
        ]);

        Patient::create([
            'acopio_id' => 1,
            'image'     => 'assets/pacientes/descarga.jpeg',
            'name'      => 'Miguel Granados',
            'edad'      => '30'
        ]);
    }
}
