<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function thanas()
    {
        return $this->hasMany(Thana::class);
    }

    public function format()
    {
        return [
            'id' => $this->id,
            'division_id' => $this->division_id,
            'bn_name' => $this->bn_name,
            'en_name' => $this->name,
        ];
    }
}
