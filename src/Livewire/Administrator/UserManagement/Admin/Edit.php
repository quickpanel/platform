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

    #[Validate('required|email|unique:admins,email,{{adminId}}')]
    public string $email = '';

    // Optional password change
    #[Validate('nullable|string|min:6|confirmed')]
    public ?string $password = null;

    public ?string $password_confirmation = null;

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
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:admins,email,' . $this->adminId,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $admin = Admin::findOrFail($this->adminId);
        $admin->name = $this->name;
        $admin->email = $this->email;
        if (!empty($this->password)) {
            $admin->password = Hash::make($this->password);
        }
        $admin->save();

        // Required by issue: use this exact message key
        Toaster::success( __('platform::common.admin_edited'));
        // Refresh the users table
        $this->dispatch('pg:eventRefresh-administrator.user-management.admin.table');

        $this->dispatch('modal-close');
    }

    public function render()
    {
        return view('platform::livewire.administrator.user-management.admin.edit');
    }
}
