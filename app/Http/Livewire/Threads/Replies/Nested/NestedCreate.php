<?php

namespace App\Http\Livewire\Threads\Replies\Nested;

use Livewire\Component;
use App\Models\NestedReply;
use Illuminate\Support\Facades\Auth;

class NestedCreate extends Component
{
    public $replyId;
    public $body;

    protected $listeners = ['nested-assign-username' => 'assignUsername'];

    public function mount($replyId)
    {
        $this->replyId = $replyId;
    }

    public function render()
    {
        return view('livewire.threads.replies.nested.nested-create');
    }

    public function assignUsername($str) 
    {
        $this->body = '@'.$str.' ';
    }

    public function store()
    {
        $this->validate(['body' => 'required']);

        $thread = NestedReply::create([
            'user_id' => Auth::user()->id,
            'reply_id' => $this->replyId,
            'body' => $this->body
        ]);

        $this->emit('nested-added');

        $this->reset('body');

        $this->closeReplyCardForAlpine();
    }

    public function closeReplyCardForAlpine()
    {
        $this->dispatchBrowserEvent('card-nested-toggle', ['open' => false, 'replyId' => $this->replyId]);
    }
}
