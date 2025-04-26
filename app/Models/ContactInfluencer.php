<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Collaboration;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactInfluencer extends Model
{
    /** @use HasFactory<\Database\Factories\ContactInfluencerFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'sector_id', 'brand_id', 'collaboration_id', 'message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function collaboration()
    {
        return $this->belongsTo(Collaboration::class);
    }
}
