<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FocusTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'notes',
        'is_completed',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    protected $attributes = [
        'is_completed' => false,
    ];
}
