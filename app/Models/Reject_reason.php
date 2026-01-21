<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reject_reason extends Model
{
   protected $fillable = [
        'case_id',
        'reason',
    ];
    public function cases(): BelongsTo
    {
        return $this->belongsTo(Cases::class, 'case_id', 'id');
    }

}