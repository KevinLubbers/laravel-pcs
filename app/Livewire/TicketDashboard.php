<?php

namespace App\Livewire;

use App\Models\Ticket;
use Livewire\WithPagination;
use Livewire\Component;

class TicketDashboard extends Component
{
    use WithPagination;
    public int $ticketsPerPage;

    public function changePerPage($value)
    {
        session(['tickets_per_page' => $value]);
        $this->resetPage();
    }

    public function mount()
    {
        $this->ticketsPerPage = session('tickets_per_page', 5);
    }
    public function render()
    {
        return view('livewire.ticket-dashboard', [
            'tickets' => Ticket::orderByDesc('id')->paginate($this->ticketsPerPage),
        ]);
    }
}
