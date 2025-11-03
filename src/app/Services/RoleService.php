<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleService
{
    public function create(array $data): Role
    {

        $data['created_by'] = Auth::id();

        return Role::create($data);
    }

    public function update(Role $group, array $data): Role
    {
        $group = Role::findOrFail($group->id);
        $data['updated_by'] = Auth::id();
        $group->update($data);

        return $group->fresh();
    }

}