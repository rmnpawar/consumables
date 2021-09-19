<?php

namespace App\Service;

use App\Category;
use App\Asset;
use App\UserRequest;

class AssetService {
    public static function assetInCategory($id)
    {
        $category = Category::where('id', $id)->with('sub_categories')->first();

        $products = [];

        foreach($category->sub_categories as $sub_category)
        {
            $ids = $sub_category->products->map(function($product) {
                return $product->id;
            })->toArray();

            if ($ids)
            {
                foreach($ids as $id)
                {
                    array_push($products, $id);
                }
            }
        }

        return Asset::whereIn('products_id',$products)->where('in_stock', 1)->with('products.sub_category.category')->get();

    }

    public static function issueAsset($request_id, $asset_id)
    {
        $user_request = UserRequest::findOrFail($request_id);

        $asset = Asset::find($asset_id);

        $asset->in_stock = 0;
        $asset->user_id = $user_request->user_id;
        $asset->section_id = $user_request->section_id;
        $asset->save();

        $user_request->asset_id = $asset_id;
        $user_request->status = 3;
        $user_request->save();

        return 1;
    }

    public static function test()
    {
        return "test";
    }
}
