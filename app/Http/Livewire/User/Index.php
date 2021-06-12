<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Index extends Component
{
    public $createUser = false;

    protected $listeners = [
        'refreshUser' => '$refresh',
        'closeCreateUser' => 'closeCreateUserHandler',
    ];

    public function render()
    {
        return view('livewire.user.index');
    }

    public function createUser()
    {
        $this->createUser = true;
    }

    public function closeCreateUserHandler()
    {
        $this->createUser = false;
    }
}
