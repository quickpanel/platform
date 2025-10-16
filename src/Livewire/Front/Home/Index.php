<?php

namespace QuickPanel\Platform\Livewire\Front\Home;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('platform::livewire.front.home.index')->layout(config('platform.layouts.front', 'platform::layouts.front'));
    }
}
