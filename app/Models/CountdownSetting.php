<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountdownSetting extends Model
{
    protected $fillable = [
        'original_end_time',
        'current_end_time',
        'extension_minutes'
    ];
    
    protected $dates = [
        'original_end_time',
        'current_end_time',
        'created_at',
        'updated_at'
    ];
}