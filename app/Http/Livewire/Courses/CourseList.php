<?php

namespace App\Http\Livewire\Courses;

use Livewire\Component;
use App\Models\Course;

class CourseList extends Component
{
    public $search = '';
    public $order = 'best-seller';

    public function render()
    {
        $courses = Course::with(['author'])
            ->withCount(['courseItems', 'users']);

        if (isset($this->search))
            $courses->where('title', 'LIKE', '%'.$this->search.'%');

        switch($this->order) {
            case 'best-seller':
                $courses->orderBy('users_count', 'desc');
                break;

            case 'newest':
                $courses->orderBy('created_at', 'desc');
                break;
        }
        
        $courses = $courses->paginate(9);
        
        return view('livewire.courses.course-list', [
            'courses' => $courses
        ]);
    }
}
