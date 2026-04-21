<?php

namespace App\Models;

use App\Enums\TwoDBetStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TwoDBet extends Model
{
    use HasUuids;

    protected $fillable = [
        "two_d_game_id",
        "user_id",
        "creator_id",
        "commission_percentage",
        "total_bet_amount",
        "total_return_amount",
        "total_win_amount",
        "total_commission_amount",
        "status",
    ];

    protected $casts = [
        "status" => TwoDBetStatus::class,
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, "creator_id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(TwoDGame::class, "two_d_game_id");
    }

    public function items(): HasMany
    {
        return $this->hasMany(TwoDBetItem::class);
    }
}
