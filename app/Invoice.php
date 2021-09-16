<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Asset;

class Invoice extends Model
{

    protected $fillable = ['supplier_id', 'invoice_date', 'total', 'quantity'];


    public function addItems($items)
    {
        foreach ($items as $item) {
            InvoiceItem::create([
                'invoice_id' => $this->attributes['id'],
                'products_id' => $item['products_id'],
                'rate' => $item['rate'],
                'quantity' => $item['quantity'],
            ]);
        }
    }

    public function items()
    {
        return $this->hasMany('App\InvoiceItem');

    }
}
