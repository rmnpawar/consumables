<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    protected $fillable = ['user_id', 'section_id', 'requesting_user_id', 'sub_category'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function requesting_user()
    {
        return $this->belongsTo('App\User', 'requesting_user_id', 'id');
    }

    public function subCategory()
    {
        return $this->belongsTo('App\SubCategory', 'sub_category', 'id');
    }

    public function category()
    {
        return $this->subCategory->category;
    }

    public function format()
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'section_id' => $this->section_id,
            'section_name' => $this->section->section_name,
            'sub_category' => $this->sub_category,
            'sub_category_name' => $this->subCategory->name,
            'category_id' => $this->category()->id,
            'category' => $this->category()->cat_name,
            'requesting_user' => $this->requesting_user->name
        ];
    }
}
