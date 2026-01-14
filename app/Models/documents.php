<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentsFactory> */
    use HasFactory;

    protected $fillable = [
        'document_id',
        'case_id',
        'filename',
        'mime_type',
        'category',
        'pages',
        'uploaded_by',
    ];

    public function case()
    {
        return $this->belongsTo(Cases::class, 'case_id', 'case_id');
    }

    public function cases()
    {
        return $this->case();
    }
}
