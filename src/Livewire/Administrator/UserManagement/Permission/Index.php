<?php

namespace QuickPanel\Platform\Livewire\Administrator\UserManagement\Permission;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout('platform::layouts.administrator')]
    public function render()
    {
        return view('platform::livewire.administrator.user-management.permission.index');
    }
}
