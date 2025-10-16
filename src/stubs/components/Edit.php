<?php

namespace QuickPanel\Platform\Livewire\Administrator\UserManagement\Admin;

use QuickPanel\Platform\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public int $adminId;

    #[Validate('required|string|min:3')]
    public string $name = '';


    public function mount(int $adminId): void
    {
        $this->adminId = $adminId;
        $user = Admin::findOrFail($adminId);
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update(): void
    {
        // Handle unique email for this user
        $this->validate();



        // Required by issue: use this exact message key
        Toaster::success( __('platform::common.updated'));
        // Refresh the users table
        $this->dispatch('pg:eventRefresh-administrator.user-management.admin.table');

        $this->dispatch('modal-close');
    }

    public function render()
    {
        return view('platform::livewire.administrator.user-management.admin.edit');
    }
}
