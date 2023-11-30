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
        ]);

        Patient::create([
            'acopio_id' => 1,
            'image'     => 'assets/pacientes/descarga.jpeg',
            'name'      => 'Daniel Rosiles',
        ]);

        Patient::create([
            'acopio_id' => 1,
            'image'     => 'assets/pacientes/descarga.jpeg',
            'name'      => 'Gerardo Canceco',
        ]);

        Patient::create([
            'acopio_id' => 1,
            'image'     => 'assets/pacientes/descarga.jpeg',
            'name'      => 'Giovanni Aranda',
        ]);

        Patient::create([
            'acopio_id' => 1,
            'image'     => 'assets/pacientes/descarga.jpeg',
            'name'      => 'Miguel Granados',
        ]);
    }
}
