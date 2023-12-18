<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'lead_id', 'user_id', 'date', 'time', 'end_date', 'visibility'];
}
