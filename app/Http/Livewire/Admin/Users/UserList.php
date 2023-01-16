<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    public function render()
    {
        $users = User::orderBy('credit', 'desc')->where('role', '!=', 3)->paginate(10);

        return view('livewire.admin.users.user-list', ['users' => $users])
            ->layout('layouts.admin');
    }

    public function upgradeUser($id) {
        User::where('id', $id)->update([ 'role' => 2 ]);
    }
}
