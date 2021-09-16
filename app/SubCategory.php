<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;
use App\Consumable;
use App\Products;

class SubCategory extends Model
{

    protected $fillable = ['category', 'name', 'category_id'];

    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    protected $appends = array('is_consumable');

    public function getIsConsumableAttribute()
    {
        $value = $this->category->consumable;
        return $value;
    }


    public function setCategoryAttribute($name) {
        return $this->attributes['category_id'] = Category::getCategoryId($name);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public static function getId($name)
    {
        $idObj = SubCategory::where('name', $name)->first('id');

        if (!$idObj) return -1;

        return $idObj['id'];
    }

    public function consumableFor()
    {
        return $this->belongsToMany('App\Products');
    }

    public function items()
    {
        return $this->hasManyThrough('App\Consumable', 'App\Products');
    }

    public function products()
    {
        return $this->hasMany("App\Products");
    }

    public function assets()
    {
        return $this->hasManyThrough("App\Asset", "App\Products");
    }
}
