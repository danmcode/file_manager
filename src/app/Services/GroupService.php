<?php

namespace App\Services;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GroupService
{
    public function create(array $data): Group
    {

        $data['created_by'] = Auth::id();

        return Group::create($data);
    }

    public function update(Group $group, array $data): Group
    {
        $group = Group::findOrFail($group->id);
        $data['updated_by'] = Auth::id();
        $group->update($data);

        return $group->fresh();
    }

}