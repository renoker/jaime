<?php

namespace Database\Seeders;

use App\Models\Acopio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcopioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Acopio::create([
            'user_id'   => 2,
            'name'      => 'Martires de Uruapan',
            'address'   => 'Cuarta Privada de Jimenez #252A ',
        ]);
    }
}
