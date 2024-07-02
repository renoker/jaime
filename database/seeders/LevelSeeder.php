<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::create([
            'level' => "SuperAdministrador",
        ]);

        Level::create([
            'level' => "Director de Acopio",
        ]);

        Level::create([
            'level' => "Editor",
        ]);
    }
}
