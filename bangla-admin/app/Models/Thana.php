<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thana extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function district(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(District::Class);
    }

    public function format(): array
    {
        return [
            'id' => $this->id,
            'district_id' => $this->district_id,
            'bn_name' => $this->bn_name,
            'en_name' => $this->name,
        ];
    }

}
