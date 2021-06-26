<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    public $createRole = false;
    public $editRole = false;
    public $deleteRole = false;
    public $search;
    public $paginate = 10;

    protected $listeners = [
        'refreshRole' => '$refresh',
        'roleStored' => 'roleStoredHandler',
        'roleUpdated' => 'roleUpdatedHandler',
        'closeRole' => 'closeRoleHandler',
        'userProhibited' => 'userProhibitedHandler',
        'roleDestroyed' => 'roleDestroyedHandler',
    ];

    protected $updateQueryString = [
        ['search' => ['except' => '']]
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        $roles = $this->search === NULL     ?
            Role::orderBy('id', 'asc')->paginate($this->paginate) :
            Role::orderBy('id', 'asc')->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate);
        $permissions = [];
        foreach ($roles as $key => $role) {
            $permissions[] = Role::find($role->id)->permissions;
        }
        return view('livewire.role.index', [
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function closeRoleHandler()
    {
        $this->editRole = false;
        $this->createRole = false;
        $this->deleteRole = false;
    }

    public function createRole()
    {
        $this->closeRoleHandler();
        $this->createRole = true;
    }

    public function roleStoredHandler()
    {
        $this->closeRoleHandler();
        session()->flash('color', 'green');
        session()->flash('message', 'Role successfully created');
    }

    public function editRole($id)
    {
        $this->closeRoleHandler();
        $this->editRole = true;
        $this->emit('roleEdit', $id);
    }

    public function roleUpdatedHandler()
    {
        $this->closeRoleHandler();
        session()->flash('color', 'green');
        session()->flash('message', 'Role successfully updated');
    }

    public function userProhibitedHandler($action)
    {
        $this->closeRoleHandler();
        session()->flash('color', 'red');
        session()->flash('message', 'You are not allowed to ' . $action . ' an role');
    }

    public function deleteRole($id)
    {
        $this->closeRoleHandler();
        $role = Role::findOrFail($id);
        $this->deleteRole = true;
        $this->emit('deleteRole', $role); // Role/Delete.php
    }

    public function roleDestroyedHandler($name)
    {
        $this->closeRoleHandler();
        session()->flash('color', 'green');
        session()->flash('message', 'Successfully delete role ' . $name);
    }
}
