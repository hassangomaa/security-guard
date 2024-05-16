<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Laravel\Sanctum\HasApiTokenuse Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes, HasRoles;




    public $table = 'users';

    protected $primaryKey = 'id';
    // Indicates if the IDs are auto-incrementing
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // Generate a UUID and set it as the primary key 'id'
            $user->id = Str::uuid()->toString();
        });
    }

    public function getGuardName()
    {
        return 'web';
    }


    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }
    #orders

    public function orders()
    {
        return $this->hasMany(Order::class);
    }




    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'user_type',
    //     'avatar'
    // ];

        protected $guarded = [];


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
    ];

    /**
     * Get the bookmarked locations for the user.
     */
    public function bookmarkLocations(): HasMany
    {
        return $this->hasMany(BookmarkLocation::class);
    }
}
