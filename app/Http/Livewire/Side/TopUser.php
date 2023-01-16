<?php

namespace App\Http\Livewire\Side;

use App\Models\User;
use Livewire\Component;

class TopUser extends Component
{
    public function render()
    {
        $users = User::select('username', 'avatar', 'credit')
            ->where('role', '!=', 3)
            ->orderBy('credit', 'desc')
            ->limit(5)
            ->get();

        return view('livewire.side.top-user', compact('users'));
    }
}
