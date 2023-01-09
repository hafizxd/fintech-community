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
        return view('livewire.threads.replies.reply-list', [
            'replies' => Reply::whereRelation('thread', 'id', $this->threadId)->orderBy('created_at', 'asc')->get()
        ]);
    }
}
