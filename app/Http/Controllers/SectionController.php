<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return response()->json(Section::all(), 200);
    }


    public function store(Request $request)
    {
        $section = Section::create($request->all());

        return response()->json($section, 201);
    }


    public function show(Section $section)
    {
        return response()->json($section, 200);
    }


    public function update(Request $request, Section $section)
    {
        $section->update($request->all());

        return response()->json($section, 201);
    }

    
    public function destroy(Section $section)
    {
        $section->delete();

        return response()->json(null, 204);
    }
}
