<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['cat_name', 'consumable', 'image_url'];

    protected $hidden = ['created_at', 'updated_at'];

    public static function getCategoryId($name)
    {
        $idObj = Category::where('cat_name', $name)->first(['id']);

        if (!$idObj) return -1;
        return $idObj['id'];
    }

    public function sub_categories()
    {
        return $this->hasMany('App\SubCategory');
    }

    public function products()
    {
        return $this->hasManyThrough('App\Products', 'App\SubCategory', 'category_id', 'sub_category_id', 'id', 'id');
    }

    public static function getConsumableCategories($categories)
    {
        $consumable_sub_categories = [];
        foreach($categories as $category)
        {
            array_push($consumable_sub_categories, [$category->sub_category->id, $category->sub_category->name]);
        }
        return $consumable_sub_categories;
    }
}
