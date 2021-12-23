<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complaint;
use App\ComplaintAction;

class ComplaintController extends Controller
{
    public function index()
    {
        return response()->json(Complaint::all()->map->format(), 200);
    }

    public function myComplaint(Request $request)
    {
        $user_id = $request->user()->id;

        $complaints = Complaint::where('user_id', '=', $user_id)->get();

        return response()->json($complaints, 200);
    }

    public function store(Request $request)
    {
        // validation logic to go here.

        $user = $request->user();

        $complaint = new Complaint();
        $complaint->user_id = $user->id;
        $complaint->section_id = $user->section_id;
        $complaint->complaint_description = $request->input("description");
        $complaint->asset_id = $request->input('asset_id') ? $request->input('asset_id') : 0;
        $complaint->status = 0;

        $complaint->save();
    }

    public function closeComplaint($id)
    {
        $complaint = Complaint::findOrFail($id);

        $complaint->status = 1;
        $complaint->save();

        return response()->json("complaint Closed", 200);
    }

    public function complaintAction(Request $request, $id)
    {
        // validation logic goes here

        $action = new ComplaintAction();

        $action->complaint_id = $id;
        $action->action = $request->input('action');
        $action->save();

        return response()->json("Action added successfully", 200);
    }

    public function complaintActions($id)
    {
        return response()->json(ComplaintAction::where('complaint_id', $id)->get(), 200);
    }
}
