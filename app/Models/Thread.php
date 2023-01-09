<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Reply;
use App\Models\NestedReply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thread extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function author() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function nestedReplies() {
        return $this->hasManyThrough(NestedReply::class, Reply::class);
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
