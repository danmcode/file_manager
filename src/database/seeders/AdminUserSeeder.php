<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where(
            'name',
            'Administrador'
        )->first();

        $group = Group::where(
            'name',
            'Desarrolladores'
        )->first();

        if (!$role || !$group) {
            $this->command->warn(
                'Roles and Groups must exists'
            );
        }

        User::updateOrCreate(
            ['email' => 'admin@fileadmin.local'],
            [
                'name' => 'Administrador del sistema',
                'password' => Hash::make('password'),
                'role_id' => $role->id,
                'group_id' => $group->id,
                'quota_limit_mb' => 10,
                'used_space_mb' => 0
            ]
        );
    }
}