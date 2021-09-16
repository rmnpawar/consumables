<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return response()->json(Permission::all(), 200);
    }

    public function store(Request $request)
    {
        $permission = Permission::create($request->all());

        return response()->json($permission, 201);
    }

    public function show(Permission $permission)
    {
        return response()->json($permission, 200);
    }


    public function update(Request $request, Permission $permission)
    {
        $permission->update($request->all());

        return response()->json($permission, 201);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return response()->json(null, 204);
    }
}
