<?php

namespace App\Models;

use App\Models\User;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function author() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function thread() {
        return $this->belongsTo(Thread::class);
    }

    public function likes() {
        return $this->morphToMany(User::class, 'likeable');
    }

    public function dislikes() {
        return $this->morphToMany(User::class, 'dislikeable');
    }

    public function isLiked() {
        return $this->likes()->where('users.id', Auth::user()->id)->exists();
    }

    public function isDisliked() {
        return $this->dislikes()->where('users.id', Auth::user()->id)->exists();
    }
}
