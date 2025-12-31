<div class="">

    <div class="flex items-center">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
            Your Tickets:
        </h2>
    </div>

    <p class="mt-4  text-sm leading-relaxed">
    <div wire:poll.120s>
            @forelse ($tickets as $ticket)
            <div class="border p-2 mb-2">
                <p><strong>Email:</strong> {{ $ticket->email }}</p>
                <p><strong>Year:</strong> {{ $ticket->year }}</p>
            </div>

            @empty

            @endforelse
        <div class="flex flex-row">
            <select wire:model="ticketsPerPage" wire:change="changePerPage($event.target.value)" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="99999">All</option>
            </select>
            <x-label class="ml-2 mt-2" for="specialist_id" value="{{ __('Tickets Shown') }}" />
        </div>

    </div>
    </p>

    <p class="mt-4 text-sm">
        <!--footer / redirect-->
        {{ $tickets->links() }}
    </p>
</div>
