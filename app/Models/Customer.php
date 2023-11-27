<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'brand',
        'customer_name',
        'phone_number',
        'email',
        'bussiness_name',
        'package',
        'amount',
        'remaining',
        'agent',
        'assigned_to',
        'welcome_email',
        'assigned_pm',
        'project_status',
        'calling',
    ];
}
