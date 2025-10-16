<?php

namespace QuickPanel\Platform\Livewire\Administrator\SettingManagement\Option;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('platform::livewire.administrator.setting-management.option.index')->layout(config('platform.layouts.administrator', 'platform::layouts.administrator'));
    }
}
