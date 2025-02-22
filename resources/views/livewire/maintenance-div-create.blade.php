<div class="col-span-6 sm:col-span-4">
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded relative dark:text-green-300 dark:border-green-600 dark:bg-green-900">{{session('success')}}</div>
    @endif
    
        <x-label for="name" value="{{ __('Division Name') }}" />
        <x-input wire:model="name" class="mt-1 block w-full mb-2" type="text" autocomplete="off" placeholder="Enter Division Name" id="name" name="name" />
        @error('name')
            <p class="text-red-400 text-xs mt-2 mb-2">{{$message}}</p>
        @enderror

        <div>
            <x-label for="specialist_id" value="{{ __('Assign Specialist -(Optional)-') }}" />
            <select wire:model="specialist_id" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                <option disabled selected value="null">Select Specialist</option>
                @foreach($specialists as $id => $name)
                
                    <option wire:key="div-{{$id}}" id="{{$id}}" value="{{$id}}" >{{$name}}</option>
                @endforeach
            </select>
        </div>            
            
        <x-button class="mt-4" wire:click="createDivision">
            {{ __('Create') }}
        </x-button>
    
</div>


