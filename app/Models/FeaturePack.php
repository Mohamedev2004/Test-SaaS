<?php

namespace App\Models;

use App\Models\Pack;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeaturePack extends Model
{
    /** @use HasFactory<\Database\Factories\FeaturePackFactory> */
    use HasFactory;
    use SoftDeletes;

}
