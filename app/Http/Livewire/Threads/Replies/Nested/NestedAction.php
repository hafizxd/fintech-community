<?php

namespace App\Http\Livewire\Threads\Replies\Nested;

use Livewire\Component;
use App\Models\NestedReply;
use Illuminate\Support\Facades\Auth;

class NestedAction extends Component
{
    public $isLiked;
    public $isDisliked;

    public NestedReply $nested;

    public function mount(NestedReply $nested)
    {
        $this->nested = $nested;

        $this->isLiked = $this->nested->isLiked();
        $this->isDisliked = $this->nested->isDisliked();
    }

    public function render()
    {
        $likesCount = $this->nested->likes()->select('id')->count();
        $dislikesCount = $this->nested->dislikes()->select('id')->count();

        return view('livewire.threads.replies.nested.nested-action', compact('likesCount', 'dislikesCount'));
    }

    public function toggleLike()
    {
        if ($this->isDisliked) {
            $this->nested->dislikes()->detach(Auth::user()->id);
            $this->isDisliked = false;
        }

        if ($this->nested->author->id !== Auth::user()->id)
            $this->manageAuthorCredit();

        $this->nested->likes()->toggle(Auth::user()->id);
        $this->isLiked = !$this->isLiked;
    }

    public function toggleDislike()
    {
        if ($this->isLiked) {
            $this->manageAuthorCredit();

            $this->nested->likes()->detach(Auth::user()->id);   
            $this->isLiked = false;
        }

        $this->nested->dislikes()->toggle(Auth::user()->id);
        $this->isDisliked = !$this->isDisliked;
    }

    protected function manageAuthorCredit()
    {
        $authorCredit = $this->nested->author->credit;

        $upd = $this->isLiked ? $authorCredit - 10 : $authorCredit + 10;

        $this->nested->author()->update(['credit' => $upd]);
    }
}
