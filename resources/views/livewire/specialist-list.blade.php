<div class=" border-gray-500 bg-gray-200 dark:bg-gray-700 text-gray-400">
    @foreach($specialists as $index => $specialist)
    <div wire:key="{{$specialist->id}}" class="flex flex-row flex-wrap gap-6 justify-between p-6 items-center" x-data="{unlockClicked: false, deleteClicked: false}">
        <div class="flex flex-col w-full">
            <div class="flex flex-row items-center w-full" >
                <div class="flex flex-col w-full">
                
                <x-input  wire:model="name" id="name{{$specialist->id}}"  type="text" class="block w-full" x-bind:disabled="!unlockClicked"  />
                <x-input wire:model="email"  id="email{{$specialist->id}}" type="email" class="block w-full" x-bind:disabled="!unlockClicked"  />
                </div>
                <div class="flex flex-col items-center">
                    <div>
                        <img height="32px" width="32px" class="mb-4 ml-2"  :src="!unlockClicked ? '{{url('imgs/locked.png')}}' : '{{url('imgs/unlocked.png')}}'" >
                    </div>
                    <div class="flex flex-row">
                        <img @click="unlockClicked = !unlockClicked" wire:click="editSpecialist({{$specialist->id}})" height="32px" width="32px" class="mr-1 cursor-pointer" :src="!darkMode ? '{{url('imgs/edit-light.png')}}' : '{{url('imgs/edit-dark.png')}}'" >
                        <img @click="deleteClicked = !deleteClicked" wire:confirm="Are you sure you want to DELETE - {{$specialist->name}}" wire:click="deleteSpecialist({{$specialist->id}})" height="32px" width="32px" class="mr-1 cursor-pointer" :src="!darkMode ? '{{url('imgs/delete-light.png')}}' : '{{url('imgs/delete-dark.png')}}'" >
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    @endforeach


</div>