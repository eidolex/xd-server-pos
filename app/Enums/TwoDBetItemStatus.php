<?php

namespace App\Enums;

enum TwoDBetItemStatus: string
{
    case Pending = "pending";
    case Confirmed = "confirmed";
    case Refunded = "refunded";
    case Won = "won";
    case Lost = "lost";
}
