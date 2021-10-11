<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumable extends Model
{
    protected $fillable = ['products_id', 'invoice_id', 'balance'];

    // protected $appends = ['brand_name'];


    public function product()
    {
        return $this->belongsTo('App\Products', 'products_id', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo("App\Invoice");
    }

    public function invoice_item()
    {
        return $this->hasOneThrough('App\InvoiceItem', 'App\Invoice');
    }

    public function getBrandNameAttribute()
    {
        return $this->product->brand_name;
    }
}
