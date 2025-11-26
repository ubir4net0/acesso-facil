<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Restaurante',
            'Universidade',
            'Escola',
            'Supermercado',
            'Hospital',
            'Clínica',
            'Parque',
            'Museu',
            'Biblioteca',
            'Shopping',
            'Teatro',
            'Cinema',
            'Estádio',
            'Academia',
            'Hotel',
            'Praia',
            'Centro Comercial',
            'Prefeitura',
            'Terminal de Ônibus',
            'Estação de Metrô',
            'Centro Cultural'
        ];

       foreach ($categorias as $nome) {
    Categoria::firstOrCreate(['nome' => $nome]);
}
    }
}
