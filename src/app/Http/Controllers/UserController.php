<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
        $perPage = $request->input(
            'per_page',
            10
        );

        $users = User::with([
            'role',
            'group'
        ])->paginate($perPage);


        return response()->json($users);
    }
}