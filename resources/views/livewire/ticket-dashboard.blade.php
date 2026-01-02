<div>

    <div class="flex items-center text-sm leading-relaxedml-3 text-xl font-semibold text-gray-900 dark:text-white">
        All Tickets List:
    </div>


    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
        <div wire:poll.5s>
            @forelse ($tickets as $ticket)
            <div x-data="{ open:false }" class="border p-2 mb-2">
                <div class="flex flex-row">
                    <x-label class="mr-2" for="status" value="{{ __('Status:') }}" />
                    <span class="inline-block w-3 h-3 rounded-full mr-2
                        @switch($ticket->status)
                            @case('unresolved') bg-red-500 @break
                            @case('in_progress') bg-yellow-400 @break
                            @case('escalated') bg-blue-500 @break
                            @case('completed') bg-green-500 @break
                            @default bg-gray-400
                        @endswitch">
                    </span>
                </div>
                <p class="flex flex-row"><x-label class="mr-2" for="email" value="{{ __('Assigned To:') }}" />{{ $ticket->users->name ?? "No Specialist"}}</p>
                <p class="flex flex-row"><x-label class="mr-2" for="email" value="{{ __('Submitted By:') }}" />{{ $ticket->email }}</p>
                <p class="flex flex-row"><x-label class="mr-2" for="task" value="{{ __('Task:') }}" />{{ $ticket->tasks->name ?? "No Task"}}</p>
                <hr>
                <p class="flex flex-row"><x-label class="mr-2" for="year" value="{{ __('Year:') }}" />{{ $ticket->year }}</p>
                <p class="flex flex-row"><x-label class="mr-2" for="division" value="{{ __('Division:') }}" />{{ $ticket->divisions->name}}</p>
                <p class="flex flex-row"><x-label class="mr-2" for="model" value="{{ __('Model:') }}" />{{ $ticket->models->name}}</p>
                <hr>
                <div class="accordion" x-on:click="open = !open" x-show="!open">Show More Details</div>
                <div class="accordion" x-show="open" x-transition x-cloak x-on:click="open = !open">
                    <div class="flex flex-row">
                        <x-label class="mr-2 accordion" for="details" value="{{ __('Details:') }}" />
                        {{$ticket->details}}
                    </div>
                    <div class="flex flex-row">
                        <x-label class="mr-2 accordion" for="misc" value="{{ __('Trim / Package Info:') }}" />
                        {{$ticket->misc}}
                    </div>
                </div>
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
    <style>
    .accordion{
        display:flex;
        flex-direction:column;
    }
    .accordion:hover{
        cursor: pointer;
    }
</style>
</div>