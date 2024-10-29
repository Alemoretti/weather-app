<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'date',
        'min_temp',
        'max_temp',
        'weather',
        'weather_icon',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
