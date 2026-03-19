<x-guest-layout>
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-teal-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 flex flex-col justify-items-center justify-between items-center">
                <div class="flex flex-row items-center mb-2 pr-4">
                    <a href="{{url('/')}}"><x-application-mark class="pr-4" /></a>
                    <div class="pr-4 pl-4">
                    @livewire('lightButton')
                    </div>
                </div>
                <div>
                    <x-nav-link href="{{ route('faq') }}" :active="request()->routeIs('faq')">
                        {{ __('FAQ') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('instructions') }}" :active="request()->routeIs('instructions')">
                        {{ __('Instructions') }}
                    </x-nav-link>
                    @auth
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @endauth
                </div>
            </div>
        @endif

        <livewire:ticket-form />
        <div x-data="{ show: false }" x-show="show" x-on:ticket-created.window="show = !show">
            <x-dialog-modal>
                <x-slot name="title">
                    <div>{{ __('Ticket Submitted') }}</div>
                    <hr>
                </x-slot>
                <x-slot name="content">
                    <div class="mt-4">
                        <p class="mb-4">Your ticket has been submitted successfully!</p>
                        <p>An email should arrive in your inbox shortly</p>
                        <p class="mt-8">Please do not submit multiple tickets for the same issue</p>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <x-button @click="show = !show" >
                        {{ __('Close') }}
                    </x-button>
                </x-slot>
            </x-dialog-modal>
        </div>
    </div>
</x-guest-layout>
