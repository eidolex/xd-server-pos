<?php

namespace App\Models;

use App\Enums\TwoDGameStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TwoDGame extends Model
{
    use HasUuids;

    protected $fillable = ["game_time_id", "release_date", "status"];

    protected $casts = [
        "release_date" => "datetime",
        "status" => TwoDGameStatus::class,
    ];

    public function time(): BelongsTo
    {
        return $this->belongsTo(TwoDGameTime::class);
    }
}
