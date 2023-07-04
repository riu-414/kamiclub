<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReserveService
{
    public static function getWeekReserves($startDate, $endDate)
    {
        return DB::table('reserves')
        ->whereBetween('start_date', [$startDate, $endDate])
        ->orderBy('start_date', 'asc')
        ->get();
    }
}
