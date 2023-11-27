<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'short',
        'description',
        'image',
        'pdf',
        'class',
    ];
}
