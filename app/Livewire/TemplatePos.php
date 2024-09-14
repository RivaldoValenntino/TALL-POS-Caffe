<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class TemplatePos extends Component
{
    #[Layout('layouts.cashier')]
    public function render()
    {
        return view('livewire.template-pos');
    }
}
