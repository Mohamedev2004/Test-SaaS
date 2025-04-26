<?php

namespace App\Models;

use App\Mail\RDVDemandNotificationMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Meeting extends Model
{
    use HasFactory;

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'name',
        'email',
        'phone',
        'meeting_date',
    ];

    protected static function booted(){
        static::created(function($meeting){
            Mail::to(config('mail.from.address'))->send(new RDVDemandNotificationMail($meeting));
        });
    }
}
