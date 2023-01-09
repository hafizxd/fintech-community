<?php

namespace App\Http\Livewire\Threads\Replies;

use App\Models\Reply;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ReplyAction extends Component
{
    public $isLiked;
    public $isDisliked;

    public Reply $reply;

    public function mount(Reply $reply)
    {
        $this->reply = $reply;

        $this->isLiked = $this->reply->isLiked();
        $this->isDisliked = $this->reply->isDisliked();
    }

    public function render()
    {
        $likesCount = $this->reply->likes()->select('id')->count();
        $dislikesCount = $this->reply->dislikes()->select('id')->count();

        return view('livewire.threads.replies.reply-action', compact('likesCount', 'dislikesCount'));
    }

    public function toggleLike()
    {
        if ($this->isDisliked) {
            $this->reply->dislikes()->detach(Auth::user()->id);
            $this->isDisliked = false;
        }

        if ($this->reply->author->id !== Auth::user()->id)
            $this->manageAuthorCredit();

        $this->reply->likes()->toggle(Auth::user()->id);
        $this->isLiked = !$this->isLiked;
    }

    public function toggleDislike()
    {
        if ($this->isLiked) {
            $this->manageAuthorCredit();

            $this->reply->likes()->detach(Auth::user()->id);   
            $this->isLiked = false;
        }

        $this->reply->dislikes()->toggle(Auth::user()->id);
        $this->isDisliked = !$this->isDisliked;
    }

    protected function manageAuthorCredit()
    {
        $authorCredit = $this->reply->author->credit;

        $upd = $this->isLiked ? $authorCredit - 10 : $authorCredit + 10;

        $this->reply->author()->update(['credit' => $upd]);
    }
}
