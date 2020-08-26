<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ['brand', 'brand_id', 'sub_category', 'sub_category_id', 'model'];

    public function setBrandAttribute($name)
    {
        $this->attributes['brand_id'] = Brand::getBrandId($name);
    }

    public function setSubCategoryAttribute($name)
    {
        $this->attributes['sub_category_id'] = SubCategory::getId($name);
    }

    public function consumables()
    {
        return $this->belongsToMany('App\SubCategory');
    }
}
