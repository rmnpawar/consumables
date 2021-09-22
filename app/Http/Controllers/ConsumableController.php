<?php

namespace App\Http\Controllers;

use App\Consumable;
use App\Service\ConsumableService;
use Illuminate\Http\Request;

class ConsumableController extends Controller
{
    public function index()
    {
        return response()->json(Consumable::with('product')->get(), 200);
    }

    public function store(Request $request)
    {
        $consumable = Consumable::create($request->all());

        return response()->json($consumable, 201);
    }

    public function availableConsumables($id)
    {
        return ConsumableService::availableConsumables($id);
    }


}
