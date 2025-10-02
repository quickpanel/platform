<?php

namespace QuickPanel\Platform\Livewire\Front\Home;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout('platform::layouts.front')]
    public function render()
    {
        return view('platform::livewire.front.home.index');
    }
}
