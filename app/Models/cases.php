<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cases extends Model
{
    /** @use HasFactory<\Database\Factories\CasesFactory> */
    use HasFactory;

    protected $fillable = ['id', 'external_ref', 'status', 'priority', 'arrival_ts', 'checkpoint_id', 'origin_country', 'destination_country', 'declerant_id', 'consignee_id', 'vehicle_id']; 

    public function risk_flags(){
        return $this->hasMany(risk_flags::class);
    }
}
