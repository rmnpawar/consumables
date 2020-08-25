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
}
