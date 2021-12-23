<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplaintAction extends Model
{
    protected $appends = ["created_on"];

   public function getCreatedOnAttribute()
   {
       return $this->created_at->format("d-m-Y");
   }
}
