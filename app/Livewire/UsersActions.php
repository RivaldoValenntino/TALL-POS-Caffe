<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UsersActions extends Component
{

    use WithFileUploads;
    public $userId;
    public $name;
    public $role;
    public $password;
    public $username;
    public $show = false;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required',
        'role' => 'required',
        'password' => 'required|min:8',
        'username' => 'required|min:6|unique:users,username',
    ];

    protected $messages = [
        'name.required' => 'Nama wajib diisi',
        'role.required' => 'Role wajib diisi',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 8 karakter',
        'username.required' => 'Username wajib diisi',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->userId = null;
        $this->name = '';
        $this->role = '';
        $this->password = '';
        $this->username = '';
        $this->isEditing = false;
    }

    public function create()
    {
        $this->resetForm();
        $this->show = true;
        $this->isEditing = false;
    }

    public function edit(User $user)
    {
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->role = $user->role;
        $this->username = $user->username;
        $this->password = $user->password;
        $this->isEditing = true;
        $this->show = true;
    }

    public function getModalTitleProperty()
    {
        return $this->isEditing ? 'Edit user' : 'Create user';
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->show = false;
        $this->isEditing = false;
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($this->userId) {
            $customer = User::findOrFail($this->userId);
            $customer->update($validatedData);
        } else {
            User::create($validatedData);
        }

        $this->dispatch('userUpdated');

        $this->show = false;
        $this->resetForm();

        toastr()->success('User saved successfully');

        return redirect()->back();
    }

    protected $listeners = ['editUser' => 'loadUser', 'deleteUser' => 'delete'];

    public function loadUser($userId)
    {
        $user = User::findOrFail($userId);
        $this->edit($user);
    }

    public function delete($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete($userId);
        $this->dispatch('userUpdated');
        toastr()->success('User deleted successfully');

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.users-actions');
    }
}