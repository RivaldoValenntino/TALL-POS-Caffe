<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

class CustomerIndex extends Component
{
    #[Title('Customers')]
    #[Url]
    public $search = '';

    protected $listeners = ['customerUpdated' => 'render', 'customerDeleted' => 'render'];

    public $loading = false;

    public function edit($customerId)
    {
        $this->dispatch('editCustomer', $customerId);
    }

    public function delete($customerId)
    {
        $this->dispatch('deleteCustomer', $customerId);
    }

    public function render()
    {
        $customers = Customer::search($this->search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('livewire.customer.customer-index', compact('customers'));
    }
}
