<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TwoDGameTime extends Model
{
    use HasUuids;

    protected $fillable = ["name", "end_time", "is_active"];

    protected $casts = [
        "end_time" => "time",
        "is_active" => "boolean",
    ];

    public function games(): HasMany
    {
        return $this->hasMany(TwoDGame::class);
    }
}
