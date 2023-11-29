<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'          => "Rodolfo Ramirez",
            'email'         => "ulises@tquis.com",
            'password'      => bcrypt("admin"),
            'age'           => "34",
            'genre'         => "Hombre",
            'phone'         => "5586789485",
            'level_id'      => 1,
        ]);

        User::create([
            'name'          => "Director",
            'email'         => "directo@tquis.com",
            'password'      => bcrypt("admin"),
            'age'           => "34",
            'genre'         => "Hombre",
            'phone'         => "5586789485",
            'level_id'      => 2,
        ]);

        User::create([
            'name'          => "Paciente 1",
            'email'         => "paciente_1@tquis.com",
            'password'      => bcrypt("admin"),
            'age'           => "34",
            'genre'         => "Hombre",
            'phone'         => "5586789485",
            'level_id'      => 3,
        ]);
    }
}
