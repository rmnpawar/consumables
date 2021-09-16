<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Consumable;

class InvoiceItem extends Model
{
    protected $fillable = ['invoice_id', 'products_id', 'rate', 'quantity'];

    protected $hidden = ['created_at', 'updated_at'];

    public function products()
    {
        return $this->belongsTo('App\Products');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    public function receiveItem($serial_nos)
    {

        if ($this->received == 1) return -1;

        if ($this->products->is_consumable) 
        {
            Consumable::create([
                'products_id' => $this->products_id,
                'invoice_id' => $this->invoice_id,
                'balance' => $this->quantity
            ]);

            $this->received = 1;
            $this->save();

            return "updation successfull";
        }
        else 
        {
            Asset::createWithItem($this, $serial_nos);

            $this->received = 1;
            $this->save();

            return "updation successfull";
        }
    }

}
