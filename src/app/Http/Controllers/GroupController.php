<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use App\Services\GroupService;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        return view('group.index');
    }

    public function edit($id)
    {
        $group = Group::find($id);

        return view(
            'group.edit',
            compact('group')
        );
    }

    public function create(Request $request)
    {
        return view(
            'group.create',
        );
    }

    public function store(StoreGroupRequest $request, GroupService $groupService)
    {
        $groupService->create($request->validated());

        return redirect()
            ->route('groups')
            ->with(
                'success',
                'Grupo creado correctamente.'
            );
    }

    public function update(UpdateGroupRequest $request, Group $group, GroupService $groupService)
    {
        $updatedGroup = $groupService->update($group, $request->validated());
        return redirect()
            ->route('groups')
            ->with('success', "Grupo {$updatedGroup->name} actualizado correctamente.");
    }

    public function destroy($id)
    {
        $group = Group::find($id);
        $group->delete();

        return redirect()
            ->route('groups')
            ->with('success', "Grupo: {$group->name} eliminado correctamente.");
    }

    public function getGroups(Request $request)
    {
        $perPage = $request->input(
            'per_page',
            10
        );

        $users = Group::paginate($perPage);

        return response()->json($users);
    }


}