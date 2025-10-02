<?php

namespace QuickPanel\Platform\Livewire\Administrator\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout('platform::layouts.administrator')]
    public function render()
    {
        return view('platform::livewire.administrator.dashboard.index');
    }
}
