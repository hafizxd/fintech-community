<?php

namespace App\Models;

use App\Models\User;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NestedReply extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function author() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function reply() {
        return $this->belongsTo(Reply::class);
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
