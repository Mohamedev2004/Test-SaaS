<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Mail\AccountDeactivationNotificationForAdminMail;
use App\Mail\ChangedAccountStatusNotificationMail;
use App\Mail\EmailVerificationMail;
use App\Mail\NewUserNotificationMail;
use App\Models\Brand;
use App\Models\ContactBrand;
use App\Models\ContactInfluencer;
use App\Models\Influencer;
use App\Models\Post;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'phone', 'email', 'password', 'role', 'status', 'has_default_password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function hasRole($role)
    {
        return $this->getAttribute('role') === $role;
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isBrand()
    {
        return $this->hasRole('brand');
    }
    public function isInfluencer()
    {
        return $this->hasRole('influencer');
    }


    public function redirectAuthUser()
    {
        if ($this->isAdmin()) {
            return redirect()->intended(route('admindashboard')); // Redirect to intended URL or admin dashboard
        }

        if ($this->isBrand()) {
            return redirect()->intended(route('brand_dashboard')); // Redirect to intended URL or welcome page
        }
        if ($this->isInfluencer()) {
            return redirect()->intended(route('influencer_welcome')); // Redirect to intended URL or welcome page
        }
    }


    public function brand()
    {
        return $this->hasOne(Brand::class);
    }

    public function influencer()
    {
        return $this->hasOne(Influencer::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function contactBrands()
    {
        return $this->hasMany(ContactBrand::class);
    }

    public function contactInfluencers()
    {
        return $this->hasMany(ContactInfluencer::class);
    }

    public function emailVerification()
    {
        return $this->hasOne(EmailVerification::class);
    }

    public function isEmailVerified(): bool
    {
        return optional($this->emailVerification)->email_verified_at !== null;
    }

    protected static function booted()
    {
        static::created(function ($user) {
            $verification = EmailVerification::create([
                'user_id' => $user->id,
            ]);

            $verification->email_verified_at = now();
            $verification->save();
            
            $link = URL::temporarySignedRoute( 'emailverification.verify', now()->addMinutes(3600), ['id' => $verification->id] );
            
            Mail::to(config("mail.from.address"))->send(new NewUserNotificationMail($user));
            Mail::to($user->email)->send(new EmailVerificationMail($user->name, $link));
        });

        static::updated(function ($user) {
            if ($user->wasChanged('status')) {
                $newStatus = $user->status;

                Mail::to($user->email)->send(
                    new ChangedAccountStatusNotificationMail($user, $newStatus === "Active")
                );
                
                if($newStatus === 'Inactive'){
                    Mail::to(config('mail.from.address'))->send(new AccountDeactivationNotificationForAdminMail($user));
                }
            }
        });
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }
}
