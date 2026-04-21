<?php

namespace App\Enums;

enum TwoDBetStatus: string
{
    case Pending = "pending";
    case Confirmed = "confirmed";
    case Refunded = "refunded";
    case Calculating = "calculating";
    case Calculated = "completed";
    case CalculationFailed = "calculation_failed";
}
