<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function getSectionNameAttribute()
    {
        return $this->section->section_name;
    }

    public function getAssetNameAttribute()
    {
        return $this->asset->asset_id;
    }

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function section()
    {
        return $this->belongsTo("App\Section");
    }

    public function asset()
    {
        return $this->belongsTo("App\Asset");
    }

    public function format()
    {
        return [
            "id" => $this->id,
            "user_name" => $this->user_name,
            "section_name" => $this->section_name,
            "description" => $this->complaint_description,
            "asset" => $this->asset_id ? $this->asset_name : "Asset not specified",
            "status" => $this->status,
            "created_at" => $this->created_at->format("d-m-Y")
        ];
    }
}
