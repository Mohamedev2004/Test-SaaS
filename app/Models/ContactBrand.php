<?php

namespace App\Models;

use App\Models\Collaboration;
use App\Models\Influencer;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactBrand extends Model
{
    /** @use HasFactory<\Database\Factories\ContactBrandFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'influencer_id', 'collaboration_id', 'message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function influencer()
    {
        return $this->belongsTo(Influencer::class);
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
