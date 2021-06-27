<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Show extends Component
{
    public $roleId;
    public $name;
    public $permissions = [];

    protected $listeners = [
        'showRole' => 'showRoleHandler',
    ];

    public function showRoleHandler($roleId)
    {
        $role = Role::findOrFail($roleId);
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->permissions = array_map('strval', $role->permissions()->get()->pluck('name')->toArray());
    }

    public function render()
    {
        return view('livewire.role.show', [
            'name' => $this->name,
            'permissions' => $this->permissions
        ]);
    }
}
