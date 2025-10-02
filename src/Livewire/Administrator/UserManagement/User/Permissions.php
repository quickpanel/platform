<?php

namespace QuickPanel\Platform\Livewire\Administrator\UserManagement\User;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Permission;

class Permissions extends Component
{
    use WithPagination;
    public User $user;
    public $search;

    public function mount($userId): void
    {
        $this->user = User::findOrFail($userId);
    }

    public function assign(Permission $permission)
    {
        if (!isset($this->user)) {
            return;
        }
        $this->user->givePermissionTo($permission->name);
        $this->dispatch('administrator.user-management.user.permissions');
        Toaster::success( __('platform::common.permission_assigned'));
    }

    public function revoke(Permission $permission): void
    {
        if (!isset($this->user)) {
            return;
        }
        $this->user->revokePermissionTo($permission->name);
        $this->dispatch('administrator.user-management.user.permissions');
        Toaster::success( __('platform::common.permission_revoked'));
    }

    #[On('administrator.user-management.user.permissions.render')]
    public function render()
    {
        //$this->authorize('administrator_user_permissions');
        if($this->search != "") {
            $permissions = Permission::where('name', 'like', '%'.$this->search.'%')->paginate(5);
        } else {
            $permissions = Permission::paginate(5);
        }
        return view('platform::livewire.administrator.user-management.user.permissions', compact('permissions'));
    }
}
