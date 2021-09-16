<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;


class UserController extends Controller
{
    public function assignRoles(Request $request, User $user)
    {
        $user->syncRoles($request->input('roles'));

        return response()->json($user->load('roles'), 201);
    }

    public function sectionList(Request $request)
    {
        $user = $request->user();

        if ($user && $user->hasRole('SectionUser'))
        {
            return User::where('section_id', $user->section_id)->get(['id', 'name', 'email']);
        }

        return User::where('id', $user->id)->get(['id', 'name', 'email']);
    }
}
