<?php

namespace QuickPanel\Platform\Livewire\Administrator\UserManagement\Admin;

use QuickPanel\Platform\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    #[Validate('required|string|min:3')]
    public string $name = '';

    #[Validate('required|email|unique:admins,email')]
    public string $email = '';

    #[Validate('required|string|min:6|confirmed')]
    public string $password = '';

    public string $password_confirmation = '';

    public function create(): void
    {
        $this->validate();

        Admin::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Required by issue: use this exact message key
        Toaster::success( __('platform::common.admin_created'));


        // Refresh the users table
        $this->dispatch('pg:eventRefresh-administrator.user-management.admin.table');

        // Close the modal (livewire-modal package)
        $this->dispatch('modal-close');

        // Reset form fields
        $this->reset(['name', 'email', 'password', 'password_confirmation']);
    }

    public function render()
    {
        return view('platform::livewire.administrator.user-management.admin.create');
    }
}
