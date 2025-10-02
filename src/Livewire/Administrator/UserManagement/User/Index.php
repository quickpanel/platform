<?php

namespace QuickPanel\Platform\Livewire\Administrator\UserManagement\User;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Index extends Component
{
    #[Layout('platform::layouts.administrator')]
    public function render()
    {
        return view('platform::livewire.administrator.user-management.user.index');
    }
}
