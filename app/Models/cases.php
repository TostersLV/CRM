<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    /** @use HasFactory<\Database\Factories\CasesFactory> */
    use HasFactory;

    protected $fillable = [
        'case_id',
        'external_ref',
        'status',
        'priority',
        'arrival_ts',
        'checkpoint_id',
        'origin_country',
        'destination_country',
        'declerant_id',
        'consignee_id',
        'vehicle_id',
    ];

    public function risk_flags()
    {
        return $this->hasMany(RiskFlags::class);
    }

    public function documents()
    {
        return $this->hasMany(Documents::class, 'case_id', 'case_id');
    }
}
