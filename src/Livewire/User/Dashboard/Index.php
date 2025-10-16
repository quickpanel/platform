<?php

namespace QuickPanel\Platform\Livewire\User\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('platform::livewire.user.dashboard.index')->layout(config('platform.layouts.user', 'platform::layouts.user'));
    }
}
