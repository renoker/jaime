<?php

namespace Database\Seeders;

use App\Models\StatesMedication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatesMedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatesMedication::create([
            'state'  => 'Liquido',
        ]);

        StatesMedication::create([
            'state'  => 'Solido',
        ]);
    }
}
