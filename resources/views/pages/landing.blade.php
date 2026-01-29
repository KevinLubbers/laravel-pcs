<x-guest-layout>
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-teal-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 flex flex-col justify-items-center justify-between items-center">
                <div class="flex flex-row justify-center items-center mb-2">
                    <a href="{{url('/')}}"><x-application-mark class="" /></a>
                    <div>
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
                    @else
                    <x-nav-link href="{{ route('login') }}">
                        {{ __('Log in') }}
                    </x-nav-link>
                    @endauth
                </div>
            </div>
        @endif

        <livewire:ticket-form />
    </div>
</x-guest-layout>
