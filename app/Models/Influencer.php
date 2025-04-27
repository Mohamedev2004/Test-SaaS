<?php

namespace App\Models;

use App\Models\ContactBrand;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Influencer extends Model
{
    /** @use HasFactory<\Database\Factories\InfluencerFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'profile_image', 'influencerName','nbr_abonne', 'influencerDescription', 'influencerAge', 'sexe', 'influencerPlatforms', 'sector_id'];

    protected $casts = [
        'influencerPlatforms' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function contacts()
    {
        return $this->hasMany(ContactBrand::class);
    }

    public function posts()
{
    return $this->hasMany(Post::class, 'user_id', 'user_id');
}


}
