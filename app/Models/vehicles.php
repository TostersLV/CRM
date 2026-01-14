<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    /** @use HasFactory<\Database\Factories\VehiclesFactory> */
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'plate_no',
        'country',
        'make',
        'model',
        'vin',
    ];
}
