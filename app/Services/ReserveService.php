<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReserveService
{
    public static function getWeekReserves($startDate, $endDate, $stylistId)
    {
        return DB::table('reserves')
        ->where('stylist', '=', $stylistId)
        ->whereBetween('start_date', [$startDate, $endDate])
        ->orderBy('start_date', 'asc')
        ->get();
    }

    public static function getStylistReserves($startDate, $endDate, $stylistId)
    {
        return DB::table('reserves')
        ->where('stylist', '=', $stylistId)
        ->whereBetween('start_date', [$startDate, $endDate])
        ->orderBy('start_date', 'asc')
        ->get();
    }
}
