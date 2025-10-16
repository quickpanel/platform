<?php

namespace QuickPanel\Platform\Livewire\Administrator\LogManagement\Activity;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('platform::livewire.administrator.log-management.activity.index')->layout(config('platform.layouts.administrator', 'platform::layouts.administrator'));
    }
}
