<?php

namespace QuickPanel\Platform\Livewire\Administrator\UserManagement\Role;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout('platform::layouts.administrator')]
    public function render()
    {
        $this->authorize('administrator_user_role_index');
        return view('platform::livewire.administrator.user-management.role.index');
    }
}
