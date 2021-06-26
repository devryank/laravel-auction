<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Update extends Component
{
    public $roleId;
    public $name;
    public $permissionId = [];


    protected $listeners = [
        'roleEdit' => 'roleEditHandler',
    ];

    public function roleEditHandler($id)
    {
        $role = Role::findOrFail($id);
        $this->roleId = $role['id'];
        $this->name = $role['name'];
        $this->permissionId = array_map('strval', $role->permissions()->get()->pluck('id')->toArray());
    }

    public function render()
    {
        return view('livewire.role.update', [
            'roles' => Role::all(),
            'permissions' => Permission::where('guard_name', 'web')->get(),
        ]);
    }

    public function update()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'permissionId' => ['required', 'array'],
        ]);

        if ($this->roleId) {
            if (request()->user()->hasPermissionTo('update roles')) {
                $role = Role::findOrFail($this->roleId);
                $role->update([
                    'name' => $this->name,
                ]);
                $role->syncPermissions($this->permissionId);

                $this->emit('roleUpdated');
            } else {
                $this->emit('userProhibited');
            }
        }
    }
}
