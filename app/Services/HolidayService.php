<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HolidayService
{
    public static function getWeekHolidays()
    {
        return DB::table('holidays')
        ->orderBy('start_holiday', 'asc')
        ->get();
    }

    public static function getStylistHolidays()
    {
        return DB::table('holidays')
        ->orderBy('start_holiday', 'asc')
        ->get();
    }
}
