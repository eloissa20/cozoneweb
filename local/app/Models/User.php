<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'contact',
        'birthday',
        'address',
        'gender',
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
    ];

    public function user_spaces()
    {
        return $this->hasMany(\App\Models\Cowork::class);
    }

    public function user_transactions()
    {
        return $this->hasMany(\App\Models\Transaction::class);
    }

    public function user_favorites()
    {
        return $this->hasMany(\App\Models\Favorite::class);
    }

    public function user_reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function user_notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
