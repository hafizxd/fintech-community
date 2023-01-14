<?php

namespace App\Http\Livewire\Threads;

use App\Models\Thread;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ThreadAction extends Component
{
    public $isLiked;
    public $isDisliked;

    public Thread $thread;

    public function mount(Thread $thread)
    {
        $this->thread = $thread;

        $this->isLiked = $this->thread->isLiked();
        $this->isDisliked = $this->thread->isDisliked();
    }

    public function render()
    {
        $likesCount = $this->thread->likes()->select('id')->count();
        $dislikesCount = $this->thread->dislikes()->select('id')->count();

        $discuss = Thread::where('id', $this->thread->id)
            ->withCount(['replies', 'nestedReplies'])
            ->first();
        $discussionsCount = $discuss->replies_count + $discuss->nested_replies_count;

        return view('livewire.threads.thread-action', compact('likesCount', 'dislikesCount', 'discussionsCount'));
    }

    public function toggleLike()
    {
        if ($this->isDisliked) {
            $this->thread->dislikes()->detach(Auth::user()->id);
            $this->isDisliked = false;
        }

        if ($this->thread->author->id !== Auth::user()->id)
            $this->manageAuthorCredit();

        $this->thread->likes()->toggle(Auth::user()->id);
        $this->isLiked = !$this->isLiked;
    }

    public function toggleDislike()
    {
        if ($this->isLiked) {
            $this->manageAuthorCredit();

            $this->thread->likes()->detach(Auth::user()->id);   
            $this->isLiked = false;
        }

        $this->thread->dislikes()->toggle(Auth::user()->id);
        $this->isDisliked = !$this->isDisliked;
    }

    protected function manageAuthorCredit()
    {
        $authorCredit = $this->thread->author->credit;

        $upd = $this->isLiked ? $authorCredit - 10 : $authorCredit + 10;

        $this->thread->author()->update(['credit' => $upd]);
    }
}
