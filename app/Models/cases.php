<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return $this->hasMany(RiskFlags::class, 'case_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany(Documents::class, 'case_id', 'case_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicles::class, 'vehicle_id', 'vehicle_id');
    }

    public function inspections()
    {
        return $this->hasMany(Inspections::class, 'case_id', 'case_id');
    }

    public function reject_reason()
    {
        return $this->hasMany(Reject_reason::class, 'case_id', 'id');
    }


    
}
