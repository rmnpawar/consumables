<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumableRequest extends Model
{
    protected $fillable = ['user_id', 'section_id', 'requesting_user_id', 'asset_id', 'sub_category_id', 'status'];
}
