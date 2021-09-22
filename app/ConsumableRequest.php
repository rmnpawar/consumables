<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumableRequest extends Model
{
    protected $fillable = ['user_id', 'section_id', 'requesting_user_id', 'asset_id', 'sub_category_id', 'status'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function asset()
    {
        return $this->belongsTo('App\Asset');
    }

    public function sub_category()
    {
        return $this->belongsTo('App\SubCategory', 'sub_category_id', 'id');
    }

    public function requesting_user()
    {
        return $this->belongsTo('App\User', 'requesting_user_id', 'id');
    }

    public function format()
    {
        return [
            'id' => $this->id,
            'asset_id' => $this->asset_id,
            'asset_name' => $this->asset->product_name,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'section_name' => $this->section->section_name,
            'requesting_user_id' => $this->requesting_user_id,
            'requesting_user_name' => $this->requesting_user->name,
            'sub_category_id' => $this->sub_category_id,
            'sub_category' => $this->sub_category->name,
            'status' => $this->status,
        ];
    }
}
