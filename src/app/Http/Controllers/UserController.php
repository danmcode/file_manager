<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
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

    public function store(StoreUserRequest $request, UserService $userService)
    {
        $userService->create($request->validated());

        return redirect()
            ->route('users')
            ->with(
                'success',
                'Usuario creado correctamente.'
            );
    }

    public function update(UpdateUserRequest $request, User $user, UserService $userService)
    {
        $updatedUser = $userService->update($user, $request->validated());

        return redirect()
            ->route('users')
            ->with('success', "Usuario {$updatedUser->name} actualizado correctamente.");
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()
            ->route('users')
            ->with('success', "Usuario: {$user->name} eliminado correctamente.");
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