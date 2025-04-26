<?php

namespace App\Models;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sector extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];

    // Reverse relationship with the Brand model
    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
}
