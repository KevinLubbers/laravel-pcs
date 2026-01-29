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
    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <h1>Instructions</h1>
                <hr>
                <ol class="list-decimal list-inside" >
                    <li class="mt-6 mb-4">Fill out the form - every field is Mandatory</li>
                    <li class="mb-4">You can attach multiple files by ctrl + clicking</li>
                    <li class="mb-4">Click the submit button</li>
                    <li class="mb-4">You will receive an email if your ticket was successful</li>
                    <li class="mb-4">An error will appear if there was an issue</li>
                    <li>Please do NOT submit multiple tickets for the same issue</li>
                </ol>

        </div>
</x-guest-layout>
