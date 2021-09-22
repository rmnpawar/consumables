<?php

namespace App\Service;

use App\Consumable;
use App\ConsumableRequest;

class ConsumableService {
    public static function availableConsumables($id)
    {
        $consumables = Consumable::join('products', 'products_id', '=', 'products.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('invoices', 'invoice_id', '=', 'invoices.id')
        ->select('*', 'consumables.id as consumable_id')
        ->where('sub_category_id', $id)
        ->get();

        return $consumables;
    }

    public static function approveConsumableRequest($request_id, $consumable_id)
    {
        $request = ConsumableRequest::find($request_id);

        $consumable = Consumable::find($consumable_id);

        $consumable->balance -= 1;
        $consumable->save();

        $request->consumable_id = $consumable_id;
        $request->status = 3;
        $request->save();

        return 1;
    }
}
