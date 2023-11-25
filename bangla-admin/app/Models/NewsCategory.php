<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;

    public function category(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
