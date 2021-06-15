<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $email;
    public $password;

    protected $listeners = [
        'closeCreateUser' => 'closeCreateUserHandler',
    ];

    public function render()
    {
        return view('livewire.user.create');
    }

    public function closeCreateUserHandler()
    {
        $this->emit('closeCreateUser');
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if (request()->user()->hasPermissionTo('create users')) {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
            $user->assignRole('super-admin');
            $this->emit('userStored');
        } else {
            $this->emit('userProhibited');
        }
    }
}
