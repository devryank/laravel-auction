<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class Delete extends Component
{
    public $roleId;
    public $name;

    protected $listeners = [
        'deleteRole' => 'deleteRoleHandler',
    ];

    public function render()
    {
        return view('livewire.role.delete', [
            'name' => $this->name,
        ]);
    }

    public function deleteRoleHandler($role)
    {
        $this->roleId = $role['id'];
        $this->name = $role['name'];
    }

    public function destroyRole()
    {
        if (request()->user()->hasRole('super-admin') or request()->user()->hasPermissionTo('delete roles')) {
            $role = Role::find($this->roleId);
            $name = $role['name'];
            $role->delete();
            $this->emit('roleDestroyed', $name);
        } else {
            $this->emit('userProhibited', 'delete');
        }
    }
}
