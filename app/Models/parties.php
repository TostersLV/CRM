<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parties extends Model
{
    /** @use HasFactory<\Database\Factories\PartiesFactory> */
    use HasFactory;

    protected $fillable = [
        'party_id',
        'type',
        'name',
        'reg_code',
        'vat',
        'country',
        'email',
        'phone',
    ];
}
