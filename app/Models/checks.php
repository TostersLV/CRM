<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class checks extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'inspection_id', 'name', 'result'];

    public function inspections(){
        return $this->belongsTo(inspections::class);
    }
}
