<?php

namespace App\Http\Controllers;

use App\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceItemController extends Controller
{
    public function receiveItem(InvoiceItem $item, Request $request)
    {
        if ($item->receiveItem($request->input('serial_nos')) == -1 )
        {
            return "already received";
        }

        return "updated";
    }
}
