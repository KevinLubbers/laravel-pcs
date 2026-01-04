<?php

namespace App\Livewire;

use App\Models\Ticket;
use Livewire\WithPagination;
use Livewire\Component;

class TicketSelfDashboard extends Component
{
    use WithPagination;
    public int $ticketsPerPage;

    public function changePerPage($value)
    {
        session(['self_tickets_per_page' => $value]);
        $this->resetPage();
    }

    public function mount()
    {
        $this->ticketsPerPage = session('self_tickets_per_page', 5);
    }
    public function render()
    {
        return view('livewire.ticket-self-dashboard', [
        'tickets' => Ticket::where('specialist_id', auth()->id())
        ->orderByDesc('id')
        ->paginate($this->ticketsPerPage),
        ]);
    }
}
