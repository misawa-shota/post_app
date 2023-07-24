<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;

class Category extends Model
{
    use HasFactory;

    public function stores(){
        return $this->belongsToMany(Store::class)->withTimestamps();
    }
}
