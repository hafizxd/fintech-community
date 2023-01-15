<?php

namespace App\Http\Livewire\Courses;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseEdit extends Component
{
    use WithFileUploads;
    
    public Course $course;

    public $inputCourse;
    public $inputCourseItems;

    protected $rules = [
        'inputCourse.title' => 'required',
        'inputCourse.thumbnail' => 'nullable|image|max:5024',
        'inputCourse.price' => 'required|numeric|min:1',
        'inputCourseItems.0.title' => 'required',
        'inputCourseItems.0.video' => 'nullable|mimetypes:video/x-ms-asf,video/x-matroska,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:302400',
        'inputCourseItems.*.title' => 'required',
        'inputCourseItems.*.video' => 'nullable|mimetypes:video/x-ms-asf,video/x-matroska,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:302400',
    ];

    public function mount(Course $course) {
        $this->course = $course;

        $this->fill([
            'inputCourse' => [
                'title' => $course->title,
                'thumbnail' => '',
                'description' => $course->description,
                'price' => $course->price
            ]
        ]);

        foreach ($course->courseItems as $item) {
            $this->fill([
                'inputCourseItems' => [[
                    'title' => $item->title,
                    'video' => ''
                ]]
            ]);
        }
    }

    public function render()
    {
        return view('livewire.courses.course-edit');
    }

    public function newItem() {
        array_push($this->courseItems, [
            'title' => '',
            'video' => ''
        ]);
    }

    public function removeItem(int $key) {
        if (count($this->courseItems) > 1)
            unset($this->courseItems[$key]);
    }

    public function update() {
        $this->validate();

        // upload photo
        $imageName = $this->course->thumbnail;
        if (!empty($this->inputCourse['thumbnail'])) {
            if(Storage::exists('courses/thumbnails/'.$this->course->thumbnail))
                Storage::delete('courses/thumbnails/'.$this->course->thumbnail);

            $imageName = 'thumbnail-'.Auth::user()->username.'-'.time().'.'.$this->inputCourse['thumbnail']->extension();
            $this->inputCourse['thumbnail']->storeAs('courses/thumbnails', $imageName);
        }

        // update course
        $inputCourse = $this->inputCourse;
        $inputCourse = array_merge($inputCourse, [
            'thumbnail' => $imageName,
            'slug' => Str::slug($inputCourse['title'])
        ]);

        $course = Course::where('id', $this->course->id)->update($inputCourse);

        // store items
        // $getID3 = new \getID3;
        // $totalDuration = 0;

        // $courseItems = $this->courseItems;
        // foreach ($courseItems as $key => $item) {
        //     $videoName = 'video-'.Auth::user()->username.'-'.$key.time().'.'.$item['video']->extension();
        //     $item['video']->storeAs('courses/videos', $videoName);

        //     $item['video'] = $videoName;

        //     $course->courseItems()->create($item);

        //     // get video duration
        //     $file = $getID3->analyze(storage_path('app/public/courses/videos/'.$videoName));
        //     $totalDuration += $file['playtime_seconds'];
        // }

        // $duration = date('H:i:s', $totalDuration);
        // $course->update([ 'duration' => $duration ]);

        return redirect()->route('class.detail', ['course' => $this->course]);
    }
}
