<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Place;
use App\Models\User;
use App\Models\Comment;

class PlaceSeeder extends Seeder
{
    public function run(): void
    {
        
        if (Categoria::count() === 0) {
            $this->command->error('Nenhuma categoria encontrada! Rode CategoriasSeeder primeiro.');
            return;
        }

        
        $usuarios = [
            ['name' => 'João Silva', 'email' => 'joao@example.com'],
            ['name' => 'Maria Souza', 'email' => 'maria@example.com'],
            ['name' => 'Pedro Lima', 'email' => 'pedro@example.com'],
        ];

        foreach ($usuarios as $u) {
            User::firstOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'password' => bcrypt('12345678'),
                    'access_level' => 1,
                ]
            );
        }

        $usuariosIds = User::pluck('id')->toArray();
$locais = [
    [
        'categoria' => 'Universidade',
        'nome' => 'Fametro - Faculdade Metropolitana de Manaus',
        'descricao' => 'Campus com rampas, elevadores e acessibilidade completa.',
        'endereco' => 'Av. Constantino Nery, 1937',
        'cidade' => 'Manaus',
        'estado' => 'AM',
        'latitude' => -3.107924,
        'longitude' => -60.025565,
    ],
    [
        'categoria' => 'Shopping',
        'nome' => 'Amazonas Shopping',
        'descricao' => 'Shopping com vagas PCD, rampas e elevadores.',
        'endereco' => 'Av. Djalma Batista, 482',
        'cidade' => 'Manaus',
        'estado' => 'AM',
        'latitude' => -3.086263,
        'longitude' => -60.017694,
    ],

     

    [
        'categoria' => 'Shopping',
        'nome' => 'Manauara Shopping',
        'descricao' => 'Totalmente acessível, com elevadores, rampas e banheiros PCD.',
        'endereco' => 'Av. Mario Ypiranga, 1300',
        'cidade' => 'Manaus',
        'estado' => 'AM',
        'latitude' => -3.101019,
        'longitude' => -60.017635,
    ],
    [
        'categoria' => 'Shopping',
        'nome' => 'Studio 5 Shopping e Convenções',
        'descricao' => 'Possui rampas, elevadores e vagas PCD.',
        'endereco' => 'Av. Rodrigo Otávio, 3555',
        'cidade' => 'Manaus',
        'estado' => 'AM',
        'latitude' => -3.117744,
        'longitude' => -59.981954,
    ],

    [
        'categoria' => 'Universidade',
        'nome' => 'UFAM - Universidade Federal do Amazonas',
        'descricao' => 'Diversos prédios com acessibilidade, rampas e percursos adaptados.',
        'endereco' => 'Av. Rodrigo Octávio, 6200',
        'cidade' => 'Manaus',
        'estado' => 'AM',
        'latitude' => -3.101722,
        'longitude' => -59.964681,
    ],
    [
        'categoria' => 'Universidade',
        'nome' => 'IFAM - Campus Manaus Centro',
        'descricao' => 'Estrutura com rampas, acessos adaptados e suporte para PCD.',
        'endereco' => 'Av. Sete de Setembro, 1975',
        'cidade' => 'Manaus',
        'estado' => 'AM',
        'latitude' => -3.132820,
        'longitude' => -60.020919,
    ],

    [
        'categoria' => 'Parque',
        'nome' => 'Parque do Idoso',
        'descricao' => 'Ambiente totalmente adaptado com rampas e acessibilidade.',
        'endereco' => 'Rua Rio Mar, Nossa Sra. das Graças',
        'cidade' => 'Manaus',
        'estado' => 'AM',
        'latitude' => -3.113418,
        'longitude' => -60.012925,
    ],
    
    [
        'categoria' => 'Teatro',
        'nome' => 'Teatro Amazonas',
        'descricao' => 'Acesso adaptado com rampas, elevadores e assentos reservados.',
        'endereco' => 'Largo de São Sebastião, Centro',
        'cidade' => 'Manaus',
        'estado' => 'AM',
        'latitude' => -3.131634,
        'longitude' => -60.023278,
    ],
];


        foreach ($locais as $l) {

            $categoria = Categoria::whereRaw('LOWER(nome) = ?', strtolower($l['categoria']))->first();

            if (!$categoria) {
                $this->command->warn("Categoria NÃO encontrada: {$l['categoria']}");
                continue;
            }

            $place = Place::firstOrCreate(
                ['nome' => $l['nome']],
                [
                    'categoria_id' => $categoria->id,
                    'descricao' => $l['descricao'],
                    'endereco' => $l['endereco'],
                    'cidade' => $l['cidade'],
                    'estado' => $l['estado'],
                    'latitude' => $l['latitude'],
                    'longitude' => $l['longitude'],
                ]
            );
        }
    }
}
  