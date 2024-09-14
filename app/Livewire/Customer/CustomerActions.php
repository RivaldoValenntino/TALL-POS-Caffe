<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CustomerActions extends Component
{


    public $customerId;
    public $name;
    public $show = false;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Nama customer wajib diisi',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->customerId = null;
        $this->name = '';
        $this->isEditing = false;
    }

    public function create()
    {
        $this->resetForm();
        $this->show = true;
        $this->isEditing = false;
    }

    public function edit(Customer $customer)
    {
        $this->customerId = $customer->id;
        $this->name = $customer->name;
        $this->isEditing = true;
        $this->show = true;
    }

    public function getModalTitleProperty()
    {
        return $this->isEditing ? 'Edit customer' : 'Create customer';
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

        if ($this->customerId) {
            $customer = Customer::findOrFail($this->customerId);
            $customer->update($validatedData);
        } else {
            Customer::create($validatedData);
        }

        $this->dispatch('customerUpdated');

        $this->show = false;
        $this->resetForm();

        toastr()->success('Customer saved successfully');

        return redirect()->back();
    }

    protected $listeners = ['editCustomer' => 'loadCustomer', 'deleteCustomer' => 'delete'];

    public function loadCustomer($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $this->edit($customer);
    }

    public function delete($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->delete($customerId);
        $this->dispatch('customerUpdated');
        toastr()->success('Customer deleted successfully');

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.customer.customer-actions');
    }
}
