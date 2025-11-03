<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index');
    }

    public function edit($id)
    {
        $role = Role::find($id);

        return view(
            'role.edit',
            compact('role')
        );
    }

    public function create(Request $request)
    {
        return view(
            'role.create',
        );
    }

    public function store(StoreRoleRequest $request, RoleService $groupService)
    {
        $groupService->create($request->validated());

        return redirect()
            ->route('roles')
            ->with(
                'success',
                'Grupo creado correctamente.'
            );
    }

    public function update(UpdateRoleRequest $request, Role $group, RoleService $roleService)
    {
        $updatedRole = $roleService->update($group, $request->validated());
        dd($updatedRole);
        return redirect()
            ->route('roles')
            ->with('success', "Rol {$updatedRole->name} actualizado correctamente.");
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect()
            ->route('roles')
            ->with('success', "Rol: {$role->name} eliminado correctamente.");
    }

    public function getRoles(Request $request)
    {
        $perPage = $request->input(
            'per_page',
            10
        );

        $users = Role::paginate($perPage);

        return response()->json($users);
    }

}