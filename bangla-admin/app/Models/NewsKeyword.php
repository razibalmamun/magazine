<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsKeyword extends Model
{
    use HasFactory;

    public function keywordItem(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Keyword','keyword_id');
    }

    public function relatedNews(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\News','news_keywords','news_id','keyword_id');
    }
}
