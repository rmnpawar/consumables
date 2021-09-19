<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRequest;

class RequestController extends Controller
{
    public function createdRequests()
    {
        $requests = UserRequest::where('status', 0)->with('user', 'section')->get()->map(function($request) {
            return $request->format();
        });

        return $requests;
    }

    public function store(Request $request)
    {
        $request = UserRequest::create([
            'user_id' => $request->input('user_id'),
            'section_id' => $request->user()->section_id,
            'requesting_user_id' => $request->user()->id,
            'sub_category' => $request->input('sub_category'),
        ]);
    }
}
