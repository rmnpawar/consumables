<?php

namespace App\Http\Controllers;

use App\Asset;
use App\AssetIssue;
use App\Service\AssetService;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Asset::all()->map->format(), 200);
    }

    public function userOrSectionAssets(Request $request)
    {
        return response()->json(Asset::listAssets($request), 200);
    }

    public function assetList()
    {
        return response()->json(Asset::where('disposed', 0)->get()->map->format(), 200);
    }

    public function assetInCategory($id)
    {
        return AssetService::assetInCategory($id);
        // return Asset::with('category')->where('category', $id)->get()->map->format();
    }

    public function issueAgainstRequest(Request $request)
    {
        if (AssetService::issueAsset($request->input('request_id'), $request->input('asset_id')))
            return 1;

        return 0;
    }

    public function assetHistory(Request $request, $id)
    {
        return response()->json(AssetIssue::where('asset_id', $id)->get()->map->format(), 200);
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
