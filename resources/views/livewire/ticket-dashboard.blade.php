<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\Ticket;
use Livewire\WithPagination; 

new class extends Component {
    use WithPagination;

    public $tickets;

    public function mount()
    {
        $this->loadTickets();
    }

    public function loadTickets()
    {
        $this->tickets = Ticket::latest()->take(20)->get();
    }

    #[On('ticket-created')]
    public function ticketCreated()
    {
        $this->loadTickets();
    }


}; ?>

<div>
    @forelse ($tickets as $ticket)
    <div class="border p-2 mb-2">
        <p><strong>Email:</strong> {{ $ticket->email }}</p>
        <p><strong>Year:</strong> {{ $ticket->year }}</p>
    </div>

    @empty

    @endforelse
</div>
