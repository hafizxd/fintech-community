<?php

namespace App\Http\Livewire\Courses;

use Livewire\Component;
use App\Models\Course;
use App\Models\CourseItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseDetail extends Component
{
    public Course $course;
    public CourseItem $courseItems;

    public $hasBroughtCourse = false;

    public function mount(Course $course)
    {
        $this->course = Course::where('id', $course->id)
            ->withCount(['courseItems', 'users'])
            ->with('courseItems')
            ->first();

        $exists = Auth::user()->courses()->where('courses.id', $course->id)->exists();

        if (Auth::user()->id !== $course->author->id && $exists) {
            $this->hasBroughtCourse = true;
        }
    }

    public function render()
    {
        $course = Course::where('id', $this->course->id)
            ->withCount(['courseItems', 'users'])
            ->first('id');

        $videoCount = $course->course_items_count;
        $buyerCount = $course->users_count;

        return view('livewire.courses.course-detail', compact('videoCount', 'buyerCount'));
    }

    public function buy()
    {
        $exists = Auth::user()->courses()->where('courses.id', $this->course->id)->exists();
        if (Auth::user()->id !== $this->course->author->id && !$exists) {
            Auth::user()->courses()->attach($this->course->id);

            $this->hasBroughtCourse = true;
        }
    }

    public function destroy() {
        $course = Course::with('courseItems')->where('id', $this->course->id)->first();

        // delete thumbnail and videos
        if(Storage::exists('courses/thumbnails/'.$course->thumbnail))
            Storage::delete('courses/thumbnails/'.$course->thumbnail);

        foreach ($course->courseItems as $item) {
            if(Storage::exists('courses/videos/'.$item->video))
                Storage::delete('courses/videos/'.$item->video);
        }
        
        $course->delete();

        return redirect()->route('class.index');
    }
}
