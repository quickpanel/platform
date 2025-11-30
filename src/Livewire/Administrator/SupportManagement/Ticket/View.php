<?php

namespace QuickPanel\Platform\Livewire\Administrator\SupportManagement\Ticket;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as HttpRequest;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use QuickPanel\Platform\Models\Support\Ticket;
use QuickPanel\Platform\Models\Support\TicketReplay;

class View extends Component
{
    public Ticket $ticket;

    public string $body = '';

    public function mount(int $ticketId)
    {
        $this->ticket = Ticket::with(['user', 'replays.user', 'replays.files', 'files'])->findOrFail($ticketId);
    }

    public function submitReplay()
    {
        $this->validate([
            'body' => ['required','string','min:1'],
        ]);

        $replay = new TicketReplay();
        $replay->user_id = Auth::id();
        $replay->ticket_id = $this->ticket->id;
        $replay->body = $this->body;
        $replay->ip = request()->ip();
        $replay->save();

        // Reset form
        $this->body = '';

        $this->ticket->status = 'answered';
        $this->ticket->save();

        // Refresh ticket with all relations to show the new replay
        $this->ticket = Ticket::with(['user', 'replays', 'replays.user', 'replays.files', 'files'])->findOrFail($this->ticket->id);
        $this->dispatch('administrator.support-management.ticket.view:replays');
        // Optionally dispatch a browser event or flash message
        Toaster::success(__('platform::common.relayed'));
    }

    #[On('administrator.support-management.ticket.view:replays')]
    #[Computed]
    public function replays()
    {
        return $this->ticket->replays()->with(['user', 'files'])->latest()->get();
    }

    public function render()
    {
        return view('platform::livewire.administrator.support-management.ticket.view')->layout(config('platform.layouts.administrator', 'platform::layouts.administrator'));
    }
}
