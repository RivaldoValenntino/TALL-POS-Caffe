<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('Dashboard')]
    public function render()
    {
        if (session()->has('first_login')) {
            toastr()
                ->info('Welcome Back! ' . Auth::user()->name);
            session()->forget('first_login');
        }
        return view('livewire.dashboard');
    }
}