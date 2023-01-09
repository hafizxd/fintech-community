<?php

namespace App\Http\Livewire\Threads\Replies\Nested;

use Livewire\Component;
use App\Models\NestedReply;

class NestedList extends Component
{
    public $replyId;

    protected $listeners = ['nested-added' => '$refresh'];

    public function mount(int $replyId)
    {
        $this->replyId = $replyId;
    }

    public function render()
    {
        $nested = NestedReply::with(['reply'])
            ->whereRelation('reply', 'id', $this->replyId)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('livewire.threads.replies.nested.nested-list', [
            'nested' => $nested
        ]);
    }
}
