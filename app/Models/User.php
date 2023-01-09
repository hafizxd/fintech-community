<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Thread;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'avatar',
        'role',
        'credit',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function threads() {
        return $this->hasMany(Thread::class);
    }

    public function likedThreads() {
        return $this->morphedByMany(Thread::class, 'likeable');
    }

    public function dislikedThreads() {
        return $this->morphedByMany(Thread::class, 'dislikeable');
    }
}
