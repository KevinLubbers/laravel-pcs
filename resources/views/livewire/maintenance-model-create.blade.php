<div class="col-span-6 sm:col-span-4">
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded relative dark:text-green-300 dark:border-green-600 dark:bg-green-900">{{session('success')}}</div>
    @endif
    
        <x-label for="name" value="{{ __('Model Name') }}" />
        <x-input wire:model.live="name" autocomplete="off" class="mt-1 block w-full mb-2" type="text" placeholder="Enter Model Name" id="name" name="name" />
        @error('name')
            <p class="text-red-400 text-xs mt-2 mb-2">{{$message}}</p>
        @enderror

        <x-label for="division_id" value="{{ __('Assign Division') }}" />
        <select wire:model.live="division_id" id="division_id" name="division_id" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
            <option disabled selected value="null">Select Division</option>
            @foreach($divisions as $id => $name)
                <option wire:key="div-{{$id}}" id="{{$id}}" value="{{$id}}" >{{$name}}</option>
            @endforeach
        </select>
        @error('division_id')
            <p class="text-red-400 text-xs mt-2 mb-2">{{$message}}</p>
        @enderror
        
        <x-label for="specialist_id" value="{{ __('Assign Specialist -(Optional)-') }}" />
            <select wire:model.live="specialist_id" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                <option disabled selected value="null">Select Specialist</option>
                @foreach($specialists as $id => $name)
                
                    <option wire:key="model-{{$id}}" id="{{$id}}" value="{{$id}}" >{{$name}}</option>
                @endforeach
            </select>
        
        <x-button class="mt-4" wire:click="createModel">
            {{ __('Create') }}
        </x-button>
    
</div>
