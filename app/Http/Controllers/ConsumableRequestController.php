<?php

namespace App\Http\Controllers;

use App\ConsumableRequest;
use App\Service\ConsumableService;
use Illuminate\Http\Request;

class ConsumableRequestController extends Controller
{
   public function approveRequest(Request $request)
   {
        return ConsumableService::approveConsumableRequest($request->input('request_id'), $request->input('consumable_id'));
   }
}
