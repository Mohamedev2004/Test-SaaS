<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandPack extends Model
{
    use HasFactory;

    protected $table = 'brand_pack';

    protected $fillable = [
        'brand_id',
        'pack_id',
        'start_date',
        'end_date',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }
}
