<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['cat_name'];

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
}
