<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class total extends Model
{
    /** @use HasFactory<\Database\Factories\TotalFactory> */
    use HasFactory;

    protected $fillable = ['id', 'vehicles', 'parties', 'users', 'cases', 'inspections', 'documents'];
}
