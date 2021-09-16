<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'updated_at'];

    public static function getBrandId($name)
    {
        $idObj = Brand::where('name', $name)->first('id');

        if (!$idObj) return -1;
        
        return $idObj['id'];
    }

    public static function getBrandName($id)
    {
        return Brand::find($id)->get('name');
    }

    public function products()
    {
        return $this->hasMany("App\Products");
    }

}
