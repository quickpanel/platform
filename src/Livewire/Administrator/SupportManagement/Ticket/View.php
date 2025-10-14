<?php

namespace QuickPanel\Platform\Livewire\Administrator\SupportManagement\Ticket;

use Livewire\Attributes\Layout;
use Livewire\Component;
use QuickPanel\Platform\Models\Support\Ticket;

class View extends Component
{
    public Ticket $ticket;

    public function mount(int $ticketId)
    {
        $this->ticket = Ticket::with(['user', 'replays', 'files'])->findOrFail($ticketId);
    }
    #[Layout('platform::layouts.administrator')]
    public function render()
    {
        return view('platform::livewire.administrator.support-management.ticket.view');
    }
}
