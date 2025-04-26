<?php

namespace App\Models;

use App\Models\Collaboration;
use App\Models\Pack;
use App\Models\Post;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'logo_image',
        'brandName',
        'brandSize',
        'brandDescription',
        'brandLocalisation',
        'pack_id',
        'collaboration_id',
        'sector_id',
    ];

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the Pack model
    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }

    // Relationship with the Collaboration model
    public function collaboration()
    {
        return $this->belongsTo(Collaboration::class);
    }

    // Relationship with the Sector model
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
    public function posts()
{
    return $this->hasMany(Post::class);
}
public function post()
{
    return $this->hasOne(Post::class, 'user_id', 'user_id');
}

// In the Brand model
public function brandPacks()
{
    return $this->hasMany(BrandPack::class, 'brand_id');
}

}
