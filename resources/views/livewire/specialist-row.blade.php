    <div wire:key="{{$specialist->id}}" class="flex flex-row flex-wrap gap-6 justify-between p-6 items-center" x-data="{unlockClicked: false, deleteClicked: false, id: '{{$specialist->id}}', name: '{{$specialist->name}}', email: '{{$specialist->email}}'}">
        <div class="flex flex-col w-full">
            <div class="flex flex-row items-center w-full" >
                <div class="flex flex-col w-full">
                
                <x-input x-init="$watch('name', value => $dispatch('edited-name', {id: id, name: name}))" x-model.lazy="name"  id="name{{$specialist->id}}"  type="text" class="block w-full" x-bind:disabled="!unlockClicked"  />
                <x-input x-init="$watch('email', value => $dispatch('edited-email', {id: id, email: email}))" x-model.lazy="email" id="email{{$specialist->id}}" type="email" class="block w-full" x-bind:disabled="!unlockClicked"  />
                </div>
                <div class="flex flex-col items-center">
                    <div>
                        <img height="32px" width="32px" class="mb-4 ml-2"  :src="!unlockClicked ? '{{url('imgs/locked.png')}}' : '{{url('imgs/unlocked.png')}}'" >
                    </div>
                    <div class="flex flex-row">
                        <img @click="unlockClicked = !unlockClicked" wire:click="" height="32px" width="32px" class="mr-1 cursor-pointer" :src="!darkMode ? '{{url('imgs/edit-light.png')}}' : '{{url('imgs/edit-dark.png')}}'" >
                        <img @click="deleteClicked = !deleteClicked" wire:click="deleteSpecialist({{$specialist->id}})" wire:confirm="Are you sure you want to DELETE - {{$specialist->name}}"  height="32px" width="32px" class="mr-1 cursor-pointer" :src="!darkMode ? '{{url('imgs/delete-light.png')}}' : '{{url('imgs/delete-dark.png')}}'" >
                    </div>
                </div>
            </div>
        </div>
        
    </div>
