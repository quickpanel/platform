<?php

namespace QuickPanel\Platform\Livewire\Front\Faq;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('platform::livewire.front.faq.index')->layout(config('platform.layouts.front', 'platform::layouts.front'));
    }
}
