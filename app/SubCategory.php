<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;

class SubCategory extends Model
{

    protected $fillable = ['category', 'name', 'category_id'];

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
}
