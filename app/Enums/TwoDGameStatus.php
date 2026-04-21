<?php

namespace App\Enums;

enum TwoDGameStatus: string
{
    case Close = "close";
    case Open = "open";
    case Confirming = "confirmed";
    case Confirmed = "confirmed";
    case Cancelled = "cancelled";
}
