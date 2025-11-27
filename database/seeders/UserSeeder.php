<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        'name' => 'Mariana Oliveira',
        'email' => 'mariana.oliveira@example.com',
        'password' => Hash::make('password123'),
    ]);

    User::create([
        'name' => 'Carlos Henrique',
        'email' => 'carlos.henrique@example.com',
        'password' => Hash::make('password123'),
    ]);

    User::create([
        'name' => 'Fernanda Costa',
        'email' => 'fernanda.costa@example.com',
        'password' => Hash::make('password123'),
    ]);

    User::create([
        'name' => 'Thiago Andrade',
        'email' => 'thiago.andrade@example.com',
        'password' => Hash::make('password123'),
    ]);

    User::create([
        'name' => 'Patrícia Mendes',
        'email' => 'patricia.mendes@example.com',
        'password' => Hash::make('password123'),
    ]);
}
}
