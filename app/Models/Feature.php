<?php

namespace App\Models;

use App\Models\Pack;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    /** @use HasFactory<\Database\Factories\FeatureFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['description'];

    public function packs()
    {
        return $this->belongsToMany(Pack::class, 'feature_pack');
    }
}
