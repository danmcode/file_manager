<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::insert([
            [
                "name" => "Desarrolladores",
                "description" => "Grupo para desarrolladores"
            ],
            [
                "name" => "Marketing",
                "description" => "Grupo de marqueting de la compañía"
            ]
        ]);
    }
}