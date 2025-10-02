<?php

namespace QuickPanel\Platform\Livewire\User\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout('platform::layouts.user')]
    public function render()
    {
        return view('platform::livewire.user.dashboard.index');
    }
}
