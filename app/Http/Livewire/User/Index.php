<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $createUser = false;
    public $editUser = false;
    public $search;
    public $paginate = 10;

    protected $listeners = [
        'refreshUser' => '$refresh',
        'userStored' => 'userStoredHandler',
        'userProhibited' => 'userProhibitedHandler',
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
        $users = $this->search === NULL     ?
            User::orderBy('id', 'asc')->paginate($this->paginate) :
            User::orderBy('id', 'asc')->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate);
        // dd($users);
        return view('livewire.user.index', [
            'users' => $users,
        ]);
    }

    public function createUser()
    {
        $this->createUser = true;
    }

    public function closeCreateUserHandler()
    {
        $this->createUser = false;
        $this->editUser = false;
    }

    public function userStoredHandler()
    {
        $this->closeCreateUserHandler();
        session()->flash('color', 'green');
        session()->flash('message', 'Successfully created user');
    }

    public function editUser($id)
    {
        $this->editUser = true;
        $this->emit('userEdit', $id);
    }

    public function userProhibitedHandler()
    {
        $this->closeCreateUserHandler();
        session()->flash('color', 'red');
        session()->flash('message', 'You are not allowed to create an user');
    }
}
