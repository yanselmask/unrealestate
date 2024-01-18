<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use  HasRoles, HasApiTokens, HasFactory, Notifiable;
    use \Conner\Likeable\Likeable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'username',
        'email',
        'password',
        'status',
        'email_verified_at',
        'about',
        'phone',
        'socials',
        'company',
        'address',
        'notifications'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => \App\Enums\UserStatus::class,
        'socials' => 'array',
        'notifications' => 'array',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        // return str_ends_with($this->email, '@yourdomain.com') && $this->hasVerifiedEmail();
        return true;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function canImpersonate()
    {
        return true;
    }

    public function metas()
    {
        return $this->morphMany(Meta::class, 'metable');
    }

    public function FullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->name . ' ' . $this->lastname
        );
    }

    public function scopePlanActive($query)
    {
        return $query->whereHas('packages', function ($query) {
            return $query->where('package_user.user_id', $this->id)
                ->where(function ($query) {
                    return $query->whereNull('package_user.end_at')
                        ->whereNull('package_user.canceled_at');
                })
                ->orWhere(function ($query) {
                    return $query->where('package_user.end_at', '>', now());
                });
        });
    }

    public function scopeActived($query)
    {
        return $query->where('status', 1);
    }

    public function havePlanActive(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->planActive()->first()
        );
    }

    public function propertiesRestants(): Attribute
    {

        return Attribute::make(
            get: fn () => $this->packages()->first()?->pivot->limit_listing - $this->packages()->first()?->pivot->used_listing
        );
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class)->withPivot(['start_at', 'end_at', 'canceled_at', 'used_listing', 'used_ads', 'limit_listing', 'limit_ads', 'status']);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function receivedReviews()
    {
        return $this->hasManyThrough(Review::class, Property::class);
    }

    public function reviewsAvg(): Attribute
    {
        return Attribute::make(
            get: fn () =>  Number::forHumans($this->receivedReviews->avg('stars') ?? 0)
        );
    }

    public function reviewsAvgDecimal(): Attribute
    {
        return Attribute::make(
            get: fn () =>  Number::forHumans($this->receivedReviews->avg('stars') ?? 0, 1)
        );
    }

    public function profilePhotoUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->profile_photo_path ? Storage::url($this->profile_photo_path) : "https://www.gravatar.com/avatar/" . md5($this->email)
        );
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function sents()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function notificationsArray(): Attribute
    {
        return Attribute::get(fn () => $this->notifications ?? []);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
