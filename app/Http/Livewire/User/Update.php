<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class Update extends Component
{
    public $userId;
    public $name;
    public $email;
    public $password;
    public $roleId;

    protected $listeners = [
        'userEdit' => 'userEditHandler',
    ];

    public function userEditHandler($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->roleId = $user->roles[0]->id;
    }

    public function render()
    {
        return view('livewire.user.update', [
            'roles' => Role::all(),
        ]);
    }

    public function update()
    {
        $user = User::findOrFail($this->userId);

        if (request()->user()->hasPermissionTo('update users')) {
            if (Auth::user()->id == $this->userId) {
                if ($this->editPassword) {
                    $this->validate([
                        'name' => ['required', 'string', 'min:2', 'max:100'],
                        'email' => ['required', 'string', 'email', 'unique:users'],
                        'role' => ['required', 'not_in:0'],
                        'password' => ['required', 'string', 'min:6'],
                    ]);

                    $user->update([
                        'name' => $this->name,
                        'email' => $this->email,
                        'role' => $this->roleId,
                        'password' => Hash::make($this->password),
                    ]);
                } else {
                    $this->validate([
                        'name' => ['required', 'string', 'min:2', 'max:100'],
                        'email' => ['required', 'string', 'email', 'unique:users'],
                        'role' => ['required', 'not_in:0'],
                    ]);

                    $user->update([
                        'name' => $this->name,
                        'email' => $this->email,
                        'role' => $this->roleId,
                    ]);
                }
            }
            if (Auth::user()->id !== $this->userId) {
                $this->validate([
                    'roleId' => ['required', 'not_in:0'],
                ]);

                // last role 
                $user->removeRole($user->roles['0']['name']);

                $user->update([
                    'role' => $this->roleId,
                ]);

                // new role
                $user->assignRole($this->roleId);
            }
        }
        $this->emit('userStored');
    }
}
