<?php

namespace QuickPanel\Platform\Livewire\Administrator\SettingManagement\Category;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout('platform::layouts.administrator')]
    public function render()
    {
        return view('platform::livewire.administrator.setting-management.category.index');
    }
}
