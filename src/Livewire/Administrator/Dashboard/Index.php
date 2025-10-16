<?php

namespace QuickPanel\Platform\Livewire\Administrator\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('platform::livewire.administrator.dashboard.index')->layout(config('platform.layouts.administrator', 'platform::layouts.administrator'));
    }
}
