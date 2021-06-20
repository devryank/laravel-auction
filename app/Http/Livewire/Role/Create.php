<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Create extends Component
{
    public $name;
    public $permission = [];

    public function render()
    {
        return view('livewire.role.create', [
            'permissions' => Permission::where('guard_name', 'sanctum')->get(),
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'permission' => ['required', 'array'],
        ]);
        if (request()->user()->hasPermissionTo('create roles')) {

            $role = Role::create(['name' => $this->name]);
            $role->givePermissionTo($this->permission);
            $this->emit('roleStored');
        } else {
            $this->emit('roleProhibited', 'create');
        }
    }
}
