<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name'];

    public static function getBrandId($name)
    {
        $idObj = Brand::where('name', $name)->first('id');

        if (!$idObj) return -1;
        
        return $idObj['id'];
    }

}
