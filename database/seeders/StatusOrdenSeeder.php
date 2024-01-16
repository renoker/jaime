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
            'status'  => 'Pedido',
        ]);

        StatusOrden::create([
            'status'  => 'Enviado',
        ]);

        StatusOrden::create([
            'status'  => 'Entregado',
        ]);
    }
}
