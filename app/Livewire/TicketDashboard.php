<?php

namespace App\Livewire;

use App\Models\Ticket;
use Livewire\WithPagination;
use Livewire\Component;
use Livewire\Attributes\On;

class TicketDashboard extends Component
{
    use WithPagination;
    public int $ticketsPerPage;

    public function changePerPage($value)
    {
        session(['tickets_per_page' => $value]);
        $this->resetPage();
    }
    public function openAttachments($id)
{
    $ticket = Ticket::findOrFail($id);

    $this->dispatch(
        'attachment',
        id: $ticket->id,
        attachments: $ticket->attachments,
        mode: 'attachment',
        title: 'View Attachment(s)'
    );
}


    public function mount()
    {
        $this->ticketsPerPage = session('tickets_per_page', 5);
    }
    #[On(event: 'status-changed')]
    #[On(event: 'ticket-reassigned')]
    public function render()
    {
        return view('livewire.ticket-dashboard', [
            'tickets' => Ticket::orderByDesc('id')->paginate($this->ticketsPerPage),
        ]);
    }
}
