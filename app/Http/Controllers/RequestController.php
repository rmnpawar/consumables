<?php

namespace App\Http\Controllers;

use App\ConsumableRequest;
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

    public function createConsumableRequest(Request $request)
    {
        $request = ConsumableRequest::create([
            'user_id' => $request->input('user_id'),
            'section_id' => $request->user()->section_id,
            'requesting_user_id' => $request->user()->id,
            'sub_category_id' => $request->input('sub_category_id'),
            'asset_id' => $request->input('asset_id'),
            'status' => 0,
        ]);

        return response()->json($request, 200);
    }

    public function consumableRequests()
    {
        $requests = ConsumableRequest::where('status', 0)->get()->map->format();

        return response()->json($requests, 200);
    }
}
