<div class="">

    <div class="flex items-center">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
            Your Tickets:
        </h2>
    </div>

        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
        <div wire:poll.120s>
            @forelse ($tickets as $ticket)
            <div x-data="{ open:false }" class="border rounded-lg shadow p-2 mb-2">
                <div class="flex flex-row items-center">
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
                    <x-label class="" for="text" value="{{ $ticket->status_label }}" x-show="open" />
                </div>
                <p class="flex flex-row items-center  dark:text-gray-200"><x-label class="mr-2" for="id" value="{{ __('Ticket Id:') }}" /> {{ $ticket->display_number ?? "No Ticket Id"}}</p>
                <hr class="mb-2 mt-2">
                <p class="flex flex-row items-center  dark:text-gray-200"><x-label class="mr-2" for="specialist" value="{{ __('Assigned To:') }}" />{{ $ticket->users->name ?? "No Specialist"}}</p>
                <p class="flex flex-row items-center  dark:text-gray-200"><x-label class="mr-2" for="email" value="{{ __('Submitted By:') }}" />{{ $ticket->email }}</p>
                <p class="flex flex-row items-center  dark:text-gray-200"><x-label class="mr-2" for="task" value="{{ __('Task:') }}" />{{ $ticket->tasks->name ?? "No Task"}}</p>
                <hr class="mb-2 mt-2">
                <p class="flex flex-row items-center  dark:text-gray-200"><x-label class="mr-2" for="year" value="{{ __('Year:') }}" />{{ $ticket->year }}</p>
                <p class="flex flex-row items-center  dark:text-gray-200"><x-label class="mr-2" for="division" value="{{ __('Division:') }}" />{{ $ticket->divisions->name}}</p>
                <p class="flex flex-row items-center  dark:text-gray-200"><x-label class="mr-2" for="model" value="{{ __('Model:') }}" />{{ $ticket->models->name}}</p>
                <hr class="mb-2 mt-2">
                <div class="accordion items-center  dark:text-gray-200" x-transition x-on:click="open = !open" x-show="!open">
                    <div>Show More Details</div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                <div class="" x-show="open" x-transition x-cloak >
                    <div class="flex flex-row items-center  dark:text-gray-200">
                        <x-label class="mr-2 " for="misc" value="{{ __('Trim / Package Info:') }}" />
                        {{$ticket->misc}}
                    </div>
                    <div class="flex flex-row items-center  dark:text-gray-200">
                        <x-label class="mr-2 " for="info_type" value="{{ __('Type:') }}" />
                        {{$ticket->info_type_label}}
                    </div>
                    <div class="flex flex-row items-center  dark:text-gray-200">
                        <x-label class="mr-2 " for="info_type" value="{{ __('Customer / Vehicle Info:') }}" />
                        {{$ticket->info_number ?? ""}}
                    </div>
                    <div class="flex flex-row items-center  dark:text-gray-200">
                        <x-label class="mr-2 " for="details" value="{{ __('Details:') }}" />
                        {{$ticket->details}}
                    </div>
                    <hr class="mb-2 mt-2">
                    <div class="flex justify-around">
                        <x-button @click="$dispatch('reassign', { 'ticket_id':{{ $ticket->id }} })" class="mt-2 mb-2">
                            {{ __('Reassign') }}
                        </x-button>
                        <x-button class="mt-2 mb-2">
                            {{ __('Attachment') }}
                        </x-button>
                        <x-button class="mt-2 mb-2">
                            {{ __('Status') }}
                        </x-button>
                        <x-button class="mt-2 mb-2">
                            {{ __('Resend') }}
                        </x-button>
                    </div>
                    <hr class="mb-2 mt-2">
                    <div x-on:click="open = !open" class="accordion items-center  dark:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                    </svg>
                    <div>Show Less Details</div>
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
</div>
