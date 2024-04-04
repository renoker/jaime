<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Medicines;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AcopioSeeder::class,
            LevelSeeder::class,
            UserSeeder::class,
            PatientSeeder::class,
            StatusOrdenSeeder::class,
            FacturationSeeder::class,
            AddressSendSeeder::class,
        ]);
    }
}
