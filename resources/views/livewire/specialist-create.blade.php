<div class="col-span-6 sm:col-span-4">
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded relative dark:text-green-300 dark:border-green-600 dark:bg-green-900">{{session('success')}}</div>
    @endif
    <form wire:submit="createSpecialist" action="">
        <x-label for="name" value="{{ __('Name') }}" />
        <x-input wire:model.defer="name" class="mt-1 block w-full mb-2" type="text" placeholder="Enter Specialist's Full Name" id="name" name="name" />
        @error('name')
            <p class="text-red-400 text-xs mt-2 mb-2">{{$message}}</p>
        @enderror
        <x-label for="email" value="{{ __('Email') }}" />
        <x-input wire:model.defer="email" class="mt-1 block w-full mb-2" type="email" placeholder="Enter Specialist's Email" id="email" name="email" />
        @error('email')
            <p class="text-red-400 text-xs mt-2 mb-2">{{$message}}</p>
        @enderror
        <x-button class="mt-4">
            {{ __('Create') }}
        </x-button>
    </form>
</div>

