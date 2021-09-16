<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return response()->json(Role::all(), 200);
    }


    public function store(Request $request)
    {
        $role = Role::create($request->all());

        return response()->json($role, 201);
    }

    public function show($role)
    {
        return response()->json(Role::findByName($role), 200);
    }


    public function update(Request $request, Role $role)
    {
        $role->update($request->all());

        return response()->json($role, 201);
    }


    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json(null, 204);
    }

    public function givePermission(Request $request, $name)
    {
        $role = Role::findByName($name);

        $role->syncPermissions($request->input('permission'));

        return response()->json($role->load('permissions'), 201);
    }

}
