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
                <a href="{{ route('faq') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm selection:border-indigo-400">FAQ</a>
                <a href="{{ route('instructions') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm selection:border-indigo-400">Instructions</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm selection:border-indigo-400 ml-2">Dashboard</a>
                @else
                    <a href="{{ url('/') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm selection:border-indigo-400">Ticket Form</a>
                @endauth
                </div>
        @endif

        
    </div>
    <div>
            <h1>Instructions<h1>
                <hr>
                <ol type="I" >
                    <li>Fill out the form - every field is Mandatory</li>
                    <li>Click the submit button</li>
                    <li>You will receive an email if your ticket was successful</li>
                    <li>An error will appear if there was an issue</li>
                    <li>Please do NOT submit multiple tickets for the same issue</li>
                </ol>

        </div>
</x-guest-layout>
