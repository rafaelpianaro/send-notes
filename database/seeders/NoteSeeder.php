<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar algumas notas para cada usuário existente
        User::all()->each(function ($user) {
            // Criar 3 notas publicadas
            Note::factory()
                ->count(3)
                ->published()
                ->create([
                    'user_id' => $user->id
                ]);

            // Criar 2 notas rascunho
            Note::factory()
                ->count(2)
                ->draft()
                ->create([
                    'user_id' => $user->id
                ]);
        });

        // Criar algumas notas com datas específicas para demonstração
        $user = User::first();
        
        Note::factory()->create([
            'user_id' => $user->id,
            'title' => 'Nota Programada para Amanhã',
            'send_date' => now()->addDay(),
            'is_published' => true,
        ]);

        Note::factory()->create([
            'user_id' => $user->id,
            'title' => 'Nota Programada para Próxima Semana',
            'send_date' => now()->addWeek(),
            'is_published' => true,
        ]);
    }
}
