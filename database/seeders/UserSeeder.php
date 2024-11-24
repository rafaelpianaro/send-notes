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
        // Criar usuários com emails específicos
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'super@example.com',
                'admin' => true,
                'super_admin' => true,
            ],
            [
                'name' => 'User Admin',
                'email' => 'admin@example.com',
                'admin' => true,
                'super_admin' => false,
            ],
            [
                'name' => 'User Test',
                'email' => 'test@example.com',
                'admin' => false,
                'super_admin' => false,
            ],
        ];

        foreach ($users as $user) {
            User::factory()->create($user);
        }

        // Cria 10 usuários aleatórios
        User::factory(3)->create();

        // // Opcionalmente, você pode criar um usuário admin fixo
        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@example.com',
        //     // a senha ainda será 12345678 como definido na factory
        // ]);
    }
}
