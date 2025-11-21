<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parties extends Model
{
    /** @use HasFactory<\Database\Factories\PartiesFactory> */
    use HasFactory;

    protected $fillable = ['id', 'type', 'name', 'reg_code', 'vat', 'country', 'email', 'phone'];
}
