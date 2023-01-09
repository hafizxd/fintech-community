<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
