<?php

namespace QuickPanel\Platform\Livewire\Administrator\UserManagement\Admin;

use QuickPanel\Platform\Models\Admin;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Permission;

class Permissions extends Component
{
    use WithPagination;
    public Admin $admin;
    public $search;

    public function mount($adminId): void
    {
        $this->admin = Admin::findOrFail($adminId);
    }

    public function assign(Permission $permission)
    {
        if (!isset($this->admin)) {
            return;
        }
        $this->admin->givePermissionTo($permission->name);
        $this->dispatch('administrator.user-management.admin.permissions');
        Toaster::success( __('platform::common.permission_assigned'));
    }

    public function revoke(Permission $permission): void
    {
        if (!isset($this->admin)) {
            return;
        }
        $this->admin->revokePermissionTo($permission->name);
        $this->dispatch('administrator.user-management.admin.permissions');
        Toaster::success( __('platform::common.permission_revoked'));
    }

    #[On('administrator.user-management.admin.permissions.render')]
    public function render()
    {
        //$this->authorize('administrator_user_permissions');
        if($this->search != "") {
            $permissions = Permission::where('name', 'like', '%'.$this->search.'%')->paginate(5);
        } else {
            $permissions = Permission::paginate(5);
        }
        return view('platform::livewire.administrator.user-management.admin.permissions', compact('permissions'));
    }
}
