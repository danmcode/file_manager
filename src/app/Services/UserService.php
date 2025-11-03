<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create(array $data): User
    {

        $data['password'] = Hash::make($data['password']);
        $data['created_by'] = Auth::id();

        return User::create($data);
    }

    public function update(User $user, array $data): User
    {
        $user = User::findOrFail($user->id);

        $data['updated_by'] = Auth::id();
        $user->update($data);

        return $user->fresh(['role', 'group']);
    }

}