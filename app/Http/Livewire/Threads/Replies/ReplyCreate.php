<?php

namespace App\Http\Livewire\Threads\Replies;

use App\Models\Reply;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ReplyCreate extends Component
{
    public $threadId;
    public $body;

    public function mount($threadId)
    {
        $this->threadId = $threadId;
    }

    public function render()
    {
        return view('livewire.threads.replies.reply-create');
    }

    public function store()
    {
        $this->validate(['body' => 'required']);

        $thread = Reply::create([
            'user_id' => Auth::user()->id,
            'thread_id' => $this->threadId,
            'body' => $this->body
        ]);

        $this->emit('reply-added');

        $this->reset('body');

        $this->closeReplyCardForAlpine();
    }

    public function closeReplyCardForAlpine()
    {
        $this->dispatchBrowserEvent('card-reply-toggle', ['open' => false]);
    }
}
