<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sponsor extends Model
{
    /** @use HasFactory<\Database\Factories\SponsorFactory> */
    use HasFactory;
    use SoftDeletes;

        protected $table = 'sponsors';

        protected $fillable = [
            'name',
            'email',
            'phone',
            'file_path',
        ];
}
