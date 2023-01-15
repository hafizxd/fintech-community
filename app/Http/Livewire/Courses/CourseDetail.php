<?php

namespace App\Http\Livewire\Courses;

use Livewire\Component;
use App\Models\Course;
use App\Models\CourseItem;
use Illuminate\Support\Facades\Storage;

class CourseDetail extends Component
{
    public Course $course;
    public CourseItem $courseItems;

    public function mount(Course $course)
    {
        $this->course = Course::where('id', $course->id)
            ->withCount(['courseItems'])
            ->with('courseItems')
            ->first();
    }

    public function render()
    {
        return view('livewire.courses.course-detail');
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
