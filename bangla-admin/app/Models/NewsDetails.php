<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsDetails extends Model
{
    use HasFactory;

    public function news()
    {
        return $this->belongsTo('App\Models\News',);
    }
}
