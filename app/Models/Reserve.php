<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Reserve extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'menu',
        'stylist',
        'message',
        // 'reserve_date',
        'start_date',
        'end_date',
    ];

    protected function reserveDate() : Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->start_date)->format('Y年m月d日')
        );
    }

    protected function editReserveDate() : Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->start_date)->format('Y-m-d')
        );
    }

    protected function startTime() : Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->start_date)->format('H時i分')
        );
    }

    protected function endTime() : Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->end_date)->format('H時i分')
        );
    }
}
