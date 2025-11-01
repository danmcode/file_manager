<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'name' => 'Administrador',
                'description' => 'Usuario con todos los privilegios',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Usuario',
                'description' => 'Usuario que puede subir archivos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}