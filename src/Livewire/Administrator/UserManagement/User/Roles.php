<?php

namespace QuickPanel\Platform\Livewire\Administrator\UserManagement\User;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use WithPagination;
    public User $user;
    public $search;

    public function mount($userId): void
    {
        $this->user = User::findOrFail($userId);
    }

    public function assign(Role $role)
    {
        if (!isset($this->user)) {
            return;
        }
        $this->user->assignRole($role->name);
        $this->dispatch('administrator.user-management.user.roles');
        Toaster::success( __('platform::common.role_assigned'));
    }

    public function delete(Role $role): void
    {
        if (!isset($this->user)) {
            return;
        }
        $this->user->removeRole($role->name);
        $this->dispatch('administrator.user-management.user.roles');
        Toaster::success( __('platform::common.role_deleted'));
    }


    #[On('administrator.user-management.user.roles.render')]
    public function render()
    {
        //$this->authorize('administrator_user_roles');
        if($this->search != "") {
            $roles = Role::where('name', 'like', '%'.$this->search.'%')->paginate();
        } else {
            $roles = Role::paginate();
        }
        return view('platform::livewire.administrator.user-management.user.roles', compact('roles'));
    }
}
