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
            'compania'      => 'Techies&Beyond',
            'name'          => 'Martires de Uruapan',
            'phone'         => '5586789485',
            'address'       => 'Cuarta Privada de Jimenez #252A ',
            'address_two'   => 'Col. San Pedro el Alto, CP, 58280',
        ]);
    }
}
