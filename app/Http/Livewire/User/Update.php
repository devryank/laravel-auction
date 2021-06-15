<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Update extends Component
{
    public $userId;
    public $name;
    public $email;
    public $password;

    protected $listeners = [
        'userEdit' => 'userEditHandler',
    ];

    public function render()
    {
        return view('livewire.user.update');
    }

    public function userEditHandler($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update()
    {
        $user = User::findOrFail($this->userId);

        if (request()->user()->hasPermissionTo('update users')) {
            if ($this->editPassword) {
                $this->validate([
                    'name' => ['required', 'string', 'min:2', 'max:100'],
                    'email' => ['required', 'string', 'email', 'unique:users'],
                    'password' => ['required', 'string', 'min:6'],
                ]);

                $user->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                ]);
            } else {
                $this->validate([
                    'name' => ['required', 'string', 'min:2', 'max:100'],
                    'email' => ['required', 'string', 'email', 'unique:users'],
                ]);

                $user->update([
                    'name' => $this->name,
                    'email' => $this->email,
                ]);
            }
        }
        $user->assignRole('super-admin');
        $this->emit('userStored');
    }
}
