<?php

namespace QuickPanel\Platform\Livewire\Administrator\SupportManagement\Ticket;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Unread extends Component
{
    public function render()
    {
        return view('platform::livewire.administrator.support-management.ticket.unread')->layout(config('platform.layouts.administrator', 'platform::layouts.administrator'));
    }
}
