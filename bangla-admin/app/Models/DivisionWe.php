<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionWe extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','order'];

    public function weare(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\WeAre','div_id');
    }
}
