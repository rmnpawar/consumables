<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetIssue extends Model
{
    public function asset()
    {
        return $this->belongsTo("App\Asset");
    }

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function section()
    {
        return $this->belongsTo("App\Section");
    }

    public function getActionAttribute()
    {
        if ($this->issue)
            return "Issued";
        else
            return "Received";
    }

    public function format()
    {
        return [
            'id' => $this->id,
            'asset_id' => $this->asset_id,
            'asset_name' => $this->asset->product_name,
            'user_name' => $this->user->name,
            'section_name' => $this->section->section_name,
            'date' => $this->issue_date,
            'action' => $this->action,
        ];
    }
}
