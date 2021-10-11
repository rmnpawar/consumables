<?php

namespace App\Http\Controllers;

use App\Consumable;
use App\ConsumableRequest;
use App\Http\Resources\ConsumableResource;
use App\Service\ConsumableService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsumableController extends Controller
{
    public function index()
    {
        return response()->json(
            Consumable::join('invoice_items', function ($join) {
                $join->on('consumables.invoice_id', '=', 'invoice_items.invoice_id')
                    ->on('invoice_items.products_id', 'consumables.products_id');
            })
                ->join('invoices', 'invoices.id', 'consumables.invoice_id')
                ->join('products', 'products.id', '=', 'consumables.products_id')
                ->join('brands', 'brands.id', 'products.brand_id')
                ->join('sub_categories', 'sub_categories.id', 'products.sub_category_id')
                ->select(
                    'consumables.id',
                    'sub_categories.id as sub_category_id',
                    'sub_categories.name as sub_category',
                    'products.id as product_id',
                    'brands.name as brand',
                    'products.model as model',
                    'invoices.invoice_number as invoice_number',
                    'invoices.invoice_date as invoice_date',
                    'invoice_items.rate as price',
                    'consumables.balance as balance')
                ->get(),
            200
        );



        // ->get();
        // return response()->json(Consumable::with('product')
        // ->join('invoice_items', function($join) {
        //     $join->on('consumables.invoice_id', '=', 'invoice_items.invoice_id');
        //     // ->where('consumables.products_id', '=', 'invoice_items.products_id');
        // })
        // ->select('consumables.id', 'rate')
        // ->get(), 200);
        // return ConsumableResource::collection((Consumable::all()));
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
