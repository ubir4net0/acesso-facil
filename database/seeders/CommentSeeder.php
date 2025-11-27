<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Place;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id')->toArray();
        $places = Place::all();

        if ($users == null || count($users) == 0) {
            $this->command->error('Nenhum usuário encontrado! Crie usuários primeiro.');
            return;
        }

        if ($places->count() === 0) {
            $this->command->error('Nenhum local encontrado! Rode PlaceSeeder primeiro.');
            return;
        }

        foreach ($places as $place) {

            $totalComments = rand(8, 18); 

            for ($i = 0; $i < $totalComments; $i++) {
                Comment::create([
                    'place_id' => $place->id,
                    'user_id' => $users[array_rand($users)], 
                    'comentario' => fake()->sentence(rand(10, 20)),
                    'estrelas' => rand(3, 5),
                ]);
            }
        }

        $this->command->info("Comentários criados com sucesso para todos os locais!");
    }
}
