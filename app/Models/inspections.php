<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inspections extends Model
{
    /** @use HasFactory<\Database\Factories\InspectionsFactory> */
    use HasFactory;

    protected $fillable = ['id', 'case_id', 'type', 'requested_by', 'start_ts', 'location', 'assigned_to'];

    public function checks(){
        return $this->hasMany(checks::class);
    }
}
