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
            'compania'      => 'Vendedor 1',
            'name'          => 'Vendedor 1',
            'phone'         => '5586789485',
            'address'       => 'Cuarta Privada de Jimenez #252A ',
            'address_two'   => 'Col. San Pedro el Alto, CP, 58280',
        ]);

        AddressSend::create([
            'acopio_id'     => 2,
            'compania'      => 'Vendedor 2',
            'name'          => 'Vendedor 2',
            'phone'         => '5586789485',
            'address'       => 'Cuarta Privada de Jimenez #252A ',
            'address_two'   => 'Col. San Pedro el Alto, CP, 58280',
        ]);
    }
}
