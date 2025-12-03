<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Criando roles...');

        $roles = [
            [
                'id' => 1,
                'name' => 'admin',
                'description' => 'Administrador do sistema'
            ],
            [
                'id' => 2,
                'name' => 'prestador',
                'description' => 'Prestador de serviços'
            ],
            [
                'id' => 3,
                'name' => 'cliente',
                'description' => 'Cliente do sistema'
            ]
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['id' => $role['id']],
                [
                    'name' => $role['name'],
                    'description' => $role['description'],
                ]
            );
            $this->command->info("Role '{$role['name']}' processado.");
        }

        $this->command->info('Roles criados/atualizados com sucesso! Total: ' . Role::count() . ' roles.');
    }
}
