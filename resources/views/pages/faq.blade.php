<x-guest-layout>
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-teal-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 flex flex-row justify-items-center justify-between items-center">
                <a href="{{url('/')}}"><x-application-mark class="" /></a>
                @livewire('lightButton')
                    <a href="{{ url('/') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm selection:outline-indigo-400 focus:border-indigo-400">Ticket Form</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:border-indigo-400 ml-2">Dashboard</a>
                @endauth
            </div>
        @endif

    </div>
</x-guest-layout>
