<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checks extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_id',
        'name',
        'result',
    ];

    public function inspections()
    {
        return $this->belongsTo(Inspections::class);
    }
}
