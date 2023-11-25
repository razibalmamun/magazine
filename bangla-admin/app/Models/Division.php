<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Division extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function format()
    {
        return [
            'id' => $this->id,
            'bn_name' => $this->bn_name,
            'en_name' => $this->name,
        ];
    }
}
