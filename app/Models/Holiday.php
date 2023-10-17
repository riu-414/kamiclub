<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'start_holiday',
        'end_holiday',
    ];

}
