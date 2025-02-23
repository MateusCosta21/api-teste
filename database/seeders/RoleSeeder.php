<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criação dos papéis (roles)
        $adminRole = Role::firstOrCreate(['nome' => 'admin']);
        $userRole = Role::firstOrCreate(['nome' => 'user']);

        // Criação do administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin21@example.com'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('senha123')
            ]
        );
        $admin->roles()->sync([$adminRole->id]);

        // Criação de um usuário normal
        $normalUser = User::firstOrCreate(
            ['email' => 'user21@example.com'],
            [
                'name' => 'Usuário Normal',
                'password' => bcrypt('senha123')
            ]
        );
        $normalUser->roles()->sync([$userRole->id]);
    }
}
