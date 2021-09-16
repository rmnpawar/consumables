<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumable extends Model
{
    protected $fillable = ['products_id', 'invoice_id', 'balance'];

    public function product()
    {
        return $this->belongsTo('App\Products', 'products_id', 'id');
    }

    public function sub_category()
    {
        
    }
}
