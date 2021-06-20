<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    public $name;
    public $email;
    public $password;
    public $roleId;

    protected $listeners = [
        'closeCreateUser' => 'closeCreateUserHandler',
    ];

    public function render()
    {
        return view('livewire.user.create', [
            'roles' => Role::all(),
        ]);
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
            'roleId' => ['required', 'not_in:0'],
        ]);

        if (request()->user()->hasPermissionTo('create users')) {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
            $user->assignRole($this->roleId);
            $this->emit('userStored');
        } else {
            $this->emit('userProhibited');
        }
    }
}
