<?php

namespace App\Models;

use App\Enums\TwoDBetItemStatus;
use App\Enums\TwoDBetStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TwoDBetItem extends Model
{
    use HasUuids;

    protected $fillable = [
        "two_d_bet_id",
        "group_key",
        "input_number",
        "number",
        "bet_amount",
        "return_amount",
        "win_amount",
        "status",
    ];

    protected $casts = [
        "status" => TwoDBetItemStatus::class,
    ];

    public function bet(): BelongsTo
    {
        return $this->belongsTo(TwoDBet::class, "two_d_bet_id");
    }
}
