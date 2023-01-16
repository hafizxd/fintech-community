<?php

namespace App\Http\Livewire\Threads\Replies;

use App\Models\Reply;
use Livewire\Component;

class ReplyList extends Component
{
    public $threadId;

    protected $listeners = ['reply-added' => '$refresh'];

    public function mount(int $threadId)
    {
        $this->threadId = $threadId;
    }

    public function render()
    {
        $replies = Reply::whereRelation('thread', 'id', $this->threadId)
            ->withCount(['likes'])
            ->orderBy('likes_count', 'desc')
            ->get();

        return view('livewire.threads.replies.reply-list', [
            'replies' => $replies
        ]);
    }
}
