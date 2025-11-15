<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
   
    public function run(): void
    {
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
            DB::table('roles')->insert([
                'id' => $role['id'],
                'name' => $role['name'],
                'description' => $role['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
