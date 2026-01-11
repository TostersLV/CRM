<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documents extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentsFactory> */
    use HasFactory;

    protected $fillable = ['id', 'document_id', 'case_id', 'filename', 'mime_type', 'category', 'pages', 'uploaded_by'];
}
