<?php

namespace App\Livewire\Setting;

use Livewire\Component;

class UserSetting extends Component
{
    public $name;
    public $username;
    public $password;

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'username' => 'required|min:6|unique:users,username',
            'password' => 'required|min:8',
        ]);
    }
    public function render()
    {
        return view('livewire.setting.user-setting');
    }
}