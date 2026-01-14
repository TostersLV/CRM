<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Total extends Model
{
    /** @use HasFactory<\Database\Factories\TotalFactory> */
    use HasFactory;

    protected $fillable = [
        'vehicles',
        'parties',
        'users',
        'cases',
        'inspections',
        'documents',
    ];
}
