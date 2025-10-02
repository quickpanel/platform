<?php

namespace QuickPanel\Platform\Livewire\Administrator\UserManagement\Admin;

use QuickPanel\Platform\Models\Admin;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use WithPagination;
    public Admin $admin;
    public $search;

    public function mount($adminId): void
    {
        $this->admin = Admin::findOrFail($adminId);
    }

    public function assign(Role $role)
    {
        if (!isset($this->admin)) {
            return;
        }
        $this->admin->assignRole($role->name);
        $this->dispatch('administrator.user-management.admin.roles');
        Toaster::success( __('platform::common.role_assigned'));
    }

    public function delete(Role $role): void
    {
        if (!isset($this->admin)) {
            return;
        }
        $this->admin->removeRole($role->name);
        $this->dispatch('administrator.user-management.admin.roles');
        Toaster::success( __('platform::common.role_deleted'));
    }


    #[On('administrator.user-management.admin.roles.render')]
    public function render()
    {
        //$this->authorize('administrator_user_roles');
        if($this->search != "") {
            $roles = Role::where('name', 'like', '%'.$this->search.'%')->paginate();
        } else {
            $roles = Role::paginate();
        }
        return view('platform::livewire.administrator.user-management.admin.roles', compact('roles'));
    }
}
