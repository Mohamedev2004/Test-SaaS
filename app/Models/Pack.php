<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pack extends Model
{
    /** @use HasFactory<\Database\Factories\PackFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','description', 'pack_type','pack_duration'];

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_pack');
    }

    protected static function booted(){
        static::creating(function ($pack) {
            switch ($pack->pack_type) {
                case '1':
                    $pack->pack_duration = 30;
                    break;
                case '3':
                    $pack->pack_duration = 90;
                    break;
                case '6':
                    $pack->pack_duration = 180;
                    break;
                case '12':
                    $pack->pack_duration = 365;
                    break;
            }
        });
    }
}
