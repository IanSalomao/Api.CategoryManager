<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obter todos os usuários criados
        $users = User::all();

        // Para cada usuário, criar algumas categorias
        $users->each(function ($user) {
            Category::create([
                'name' => 'Category 1 for ' . $user->name,
                'description' => 'This is a description for Category 1',
                'id_user' => $user->id_user,
            ]);

            Category::create([
                'name' => 'Category 2 for ' . $user->name,
                'description' => 'This is a description for Category 2',
                'id_user' => $user->id_user,
            ]);
        });
    }
}
