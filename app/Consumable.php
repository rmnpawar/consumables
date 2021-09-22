<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumable extends Model
{
    protected $fillable = ['products_id', 'invoice_id', 'balance'];

    // protected $appends = ['brand_name'];

    protected $hidden = ['product'];

    public function product()
    {
        return $this->belongsTo('App\Products', 'products_id', 'id');
    }

    public function getBrandNameAttribute()
    {
        return $this->product->brand_name;
    }
}
