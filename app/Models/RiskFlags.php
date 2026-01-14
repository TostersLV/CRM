<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiskFlags extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'case_id', 'flag'];

    public function cases(){
        return $this->belongsTo(Cases::class);
    }

}
