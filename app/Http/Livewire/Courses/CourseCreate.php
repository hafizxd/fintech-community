<?php

namespace App\Http\Livewire\Courses;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CourseCreate extends Component
{
    use WithFileUploads;

    public $course;
    public $courseItems;

    protected $rules = [
        'course.title' => 'required|unique:courses,title',
        'course.thumbnail' => 'required|image|max:5024',
        'course.price' => 'required|numeric|min:1',
        'courseItems.0.title' => 'required',
        'courseItems.0.video' => 'required|mimetypes:video/x-ms-asf,video/x-matroska,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
        'courseItems.*.title' => 'required',
        'courseItems.*.video' => 'required|mimetypes:video/x-ms-asf,video/x-matroska,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
    ];

    public function mount() 
    {
        $this->fill([
            'course' => [
                'title' => '',
                'thumbnail' => '',
                'description' => '',
                'price' => ''
            ],
            'courseItems' => [[
                'title' => '',
                'video' => ''
            ]]
        ]);
    }

    public function render()
    {
        return view('livewire.courses.course-create');
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

    public function store() {
        $this->validate();

        // upload photo
        $imageName = 'thumbnail-'.Auth::user()->username.'-'.time().'.'.$this->course['thumbnail']->extension();
        $this->course['thumbnail']->storeAs('courses/thumbnails', $imageName);

        // store course
        $course = $this->course;
        $course = array_merge($course, [
            'thumbnail' => $imageName,
            'user_id' => Auth::user()->id,
            'slug' => Str::slug($course['title'])
        ]);

        $course = Course::create($course);

        // store items
        $getID3 = new \getID3;
        $totalDuration = 0;

        $courseItems = $this->courseItems;
        foreach ($courseItems as $key => $item) {
            $videoName = 'video-'.Auth::user()->username.'-'.$key.time().'.'.$item['video']->extension();
            $item['video']->storeAs('courses/videos', $videoName);

            $item['video'] = $videoName;

            $course->courseItems()->create($item);

            // get video duration
            $file = $getID3->analyze(storage_path('app/public/courses/videos/'.$videoName));
            $totalDuration += $file['playtime_seconds'];
        }
        
        $dt = new \DateTime('now', new \DateTimeZone('UTC')); 
        $dt->setTimestamp($totalDuration);
        $duration = $dt->format('H:i:s');

        $course->update([ 'duration' => $duration ]);

        return redirect()->route('class.index');
    }
}
