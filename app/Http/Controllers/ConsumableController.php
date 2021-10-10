<?php

namespace App\Http\Controllers;

use App\Consumable;
use App\ConsumableRequest;
use App\Service\ConsumableService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsumableController extends Controller
{
    public function index()
    {
        return response()->json(Consumable::with('product')->get(), 200);
    }

    public function consumable_summary()
    {
        $summary = Consumable::join('products', 'products.id', '=', 'products_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
            ->select('products.sub_category_id', 'sub_categories.name', DB::raw('SUM(balance) as balance'))
            ->groupBy('products.sub_category_id')
            ->get();

        return response()->json($summary, 200);
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

    public function issueHistory(Request $request)
    {
        $query = ConsumableRequest::query();

        if ($request->has('asset_id')) {
            $query->where('asset_id', $request->get('asset_id'));
        }

        if ($request->has('sub_category_id')) {
            $query->where('sub_category_id', $request->get('sub_category_id'));
        }

        if ($request->has('consumable_id')) {
            $query->where('consumable_id', $request->get('consumable_id'));
        }

        if ($request->has('section_id')) {
            $query->where('section_id', $request->get('section_id'));
        }

        $issues = $query->where('status', 3)->get()->map->format();

        return $issues;

        return response()->json($issues, 200);
    }
}
