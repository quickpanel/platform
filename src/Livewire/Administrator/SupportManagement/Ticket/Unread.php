<?php

namespace QuickPanel\Platform\Livewire\Administrator\SupportManagement\Ticket;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Unread extends Component
{
    #[Layout('platform::layouts.administrator')]
    public function render()
    {
        return view('platform::livewire.administrator.support-management.ticket.unread');
    }
}
