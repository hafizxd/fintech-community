<?php

namespace App\Models;

use App\Models\User;
use App\Models\CourseItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function author() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function courseItems() {
        return $this->hasMany(CourseItem::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'buyers');
    }
}
