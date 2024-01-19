<?php

namespace Database\Seeders;

use App\Models\AddressSend;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AddressSend::create([
            'acopio_id'     => 1,
            'compania'      => 'Techies&Beyond',
            'name'          => 'Martires de Uruapan',
            'phone'         => '5586789485',
            'address'       => 'Cuarta Privada de Jimenez #252A ',
            'address_two'   => 'Col. San Pedro el Alto, CP, 58280',
        ]);
    }
}
