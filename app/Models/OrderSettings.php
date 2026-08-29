<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderSettings extends Model
{
    protected $fillable = [
        'price_per_mile',
        'distance_limit_in_miles',
    ];
}
