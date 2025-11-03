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

}