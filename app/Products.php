<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ['brand', 'brand_id', 'sub_category', 'sub_category_id', 'model'];

    protected $hidden = ['brand_id', 'created_at', 'updated_at'];

    protected $appends = ['is_consumable'];

    protected $with = ['consumables'];

    public function setBrandNameAttribute($name)
    {
        $this->attributes['brand_id'] = Brand::getBrandId($name);
    }

    public function getBrandNameAttribute()
    {
        return $this->brand->name;
    }

    public function getIsConsumableAttribute()
    {
        return $this->sub_category->category->consumable;
    }

    public function setSubCategoryAttribute($name)
    {
        $this->attributes['sub_category_id'] = SubCategory::getId($name);
    }

    public function consumables()
    {
        return $this->belongsToMany('App\SubCategory');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function sub_category()
    {
        return $this->belongsTo('App\SubCategory');
    }
}
