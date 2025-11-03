<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return view('user.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $groups = Group::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');

        return view(
            'user.edit',
            compact('user', 'roles', 'groups')
        );
    }

    public function create(Request $request)
    {
        $groups = Group::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');

        return view(
            'user.create',
            compact('groups', 'roles')
        );
    }

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