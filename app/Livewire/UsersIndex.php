<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class UsersIndex extends Component
{
    #[Title('Users')]
    protected $listeners = ['userUpdated' => 'render', 'userDeleted' => 'render', 'userUpdated' => 'render'];

    public $loading = false;
    public function edit($userId)
    {
        $this->dispatch('editUser', $userId);
    }

    public function delete($userId)
    {
        $this->dispatch('deleteUser', $userId);
    }

    public function updateRole($userId, $role)
    {
        $user = User::findOrFail($userId);
        $user->update(['role' => $role]);
        $this->dispatch('userUpdated');
        toastr()->success('Role updated successfully');
    }
    public function render()
    {
        $users = User::paginate(10);
        return view('livewire.users-index', compact('users'));
    }
}
