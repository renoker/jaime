<?php

namespace Database\Seeders;

use App\Models\StatusOrden;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusOrdenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusOrden::create([
            'status'    => 'Solicitud de cotización',
        ]);

        StatusOrden::create([
            'status'    => 'Envío de cotización',
        ]);

        StatusOrden::create([
            'status'    => 'Confirmación de la cotización y pago',
        ]);

        StatusOrden::create([
            'status'    => 'Envío',
        ]);

        StatusOrden::create([
            'status'    => 'Entregado',
        ]);
    }
}
