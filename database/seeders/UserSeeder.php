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
            'acopio_id'     => null
        ]);

        User::create([
            'name'          => "Director",
            'email'         => "directo@tquis.com",
            'password'      => bcrypt("admin"),
            'age'           => "34",
            'genre'         => "Hombre",
            'phone'         => "5586789485",
            'level_id'      => 2,
            'acopio_id'     => 1
        ]);

        User::create([
            'name'          => "Manuel",
            'email'         => "manuel@tquis.com",
            'password'      => bcrypt("admin"),
            'age'           => "34",
            'genre'         => "Hombre",
            'phone'         => "5586789485",
            'level_id'      => 2,
            'acopio_id'     => 2
        ]);
    }
}
