<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return response()->json(Invoice::all(), 200);
    }

    public function store(Request $request)
    {
        $invoice = Invoice::create($request->all());

        return response()->json($invoice, 201);
    }

    public function show(Invoice $invoice)
    {
        return response()->json($invoice->load('items', 'items.products:id,model,sub_category_id,brand_id', 'items.products.sub_category', 'items.products.brand'), 200);
    }

    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update($request->all());

        return response()->json($invoice, 201);
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json(null, 204);
    }

    public function addItems(Request $request, Invoice $invoice)
    {
        $invoice->addItems($request->input('items'));
        $invoice->processed = true;
        $invoice->save();

        return response()->json($invoice->items, 201);
    }
}
