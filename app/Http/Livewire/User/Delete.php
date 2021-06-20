<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Delete extends Component
{
    public $userId;
    public $name;

    protected $listeners = [
        'deleteUser' => 'deleteUserHandler',
    ];

    public function render()
    {
        return view('livewire.user.delete', [
            'name' => $this->name,
        ]);
    }

    public function deleteUserHandler($user)
    {
        $this->userId = $user['id'];
        $this->name = $user['name'];
    }

    public function destroyUser()
    {
        if (Auth::user()->hasRole('super-admin') or Auth::user()->id == $this->userId) {
            $user = User::find($this->userId);
            $name = $user['name'];
            $user->delete();
            $this->emit('userDestroyed', $name);
        } else {
            $this->emit('userProhibited', 'delete');
        }
    }
}
