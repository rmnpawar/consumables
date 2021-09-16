<?php

namespace App\Http\Controllers;

use App\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Asset::all(), 200);
    }

    public function userOrSectionAssets(Request $request)
    {
        return response()->json(Asset::listAssets($request), 200);
    }

    public function assetList()
    {
        return response()->json(Asset::where('disposed', 0)->get());
    }

    
    public function store(Request $request)
    {
        $asset = Asset::create($request->all());

        return response()->json($asset, 201);
    }

    
    public function show(Asset $asset)
    {
        return response()->json($asset, 200);
    }

    
    public function update(Request $request, Asset $asset)
    {
        $asset->update($request->all());

        return response()->json($asset, 201);
    }


    public function destroy(Asset $asset)
    {
        $asset->delete();

        return response(null, 204);
    }

    public function test(Request $request)
    {
        $asset = Asset::createWithAssetNumber($request->all());

        return response()->json($asset, 201);
    }
}
