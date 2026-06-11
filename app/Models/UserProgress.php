<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    /** @use HasFactory<\Database\Factories\UserProgressFactory> */
    use HasFactory;

    protected $table = 'user_progress';

    protected $fillable = ['user_id', 'lesson_id', 'completed_at'];

    protected $casts = [
        'completed_at' => 'datetime',
    ];
}
