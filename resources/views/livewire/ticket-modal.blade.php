<?php

use App\Models\User;
use Livewire\Attributes\On;
use App\Models\Division;
use App\Models\CarModel;
use Livewire\Volt\Component;

use App\Models\Ticket;

new class extends Component {
    
    public $showMe;
    public $specialists;
    public $id;
    public $name;
    public $specialist;
    public $type;
    public $ticket;
    public $status;


    
    public function resendTicket($id){
        //add email functionality eventually
        $send = "";
    }
    public function reassignSpecialist($id, $specialist){
        $ticket = Ticket::findOrFail($id);
        $ticket->specialist_id = $specialist;
        $ticket->save();
        request()->session()->flash('success', 'Ticket Specialist Successfully Updated!');
        $this->dispatch('ticket-reassigned');
        $this->dispatch('item-updated', id: $id);
        $this->resendTicket($id);
    }
    public function changeStatus($id, $status){
        $ticket = Ticket::findOrFail($id);
        $ticket->status = $status;
        $this->$status= $status;
        $ticket->save();
        request()->session()->flash('success', 'Ticket Status Successfully Updated!');
        $this->dispatch('status-changed');
        $this->dispatch('item-updated', id: $id);
        
    }
    


    public function routeSave($id, $specialist, $title, $status = null){
        switch ($title) {
            case 'Reassign Ticket':
                $this->reassignSpecialist($id, $specialist);
                break;
            case 'Change Status':
                $this->changeStatus($id, $status);
                break;
            case 'Resend Ticket':
                $this->resendTicket($id, $specialist);
                break;
        }
    }


    public function mount(){
        $this->specialists = User::pluck('name', 'id')->all();
        $this->showMe = false;
    }

}; ?>
<div>
<div x-data="{ show: @entangle('showMe'), id:'', attachments:[], title: '', name: '', mode: '', status: @entangle('status'), specialist: @entangle('specialist') }" x-show="show"
    @reassign.window="show = !show, id = $event.detail.id, mode = $event.detail.mode, name = $event.detail.name, specialist = $event.detail.specialist, title = $event.detail.title"
    @attachment.window="show = !show, id = $event.detail.id, attachments = $event.detail.attachments, mode = $event.detail.mode, title = $event.detail.title"
    @status.window="show = !show, id = $event.detail.id, mode = $event.detail.mode, status = $event.detail.status, title = $event.detail.title"
    @resend.window="show = !show, id = $event.detail.id, mode = $event.detail.mode, title = $event.detail.title" >
    <x-dialog-modal>
        <x-slot name="title">
            <div x-text="title">{{ __('Title') }}</div>
        </x-slot>

        <x-slot name="content">

            <template x-if="mode === 'reassign'">
            <div class="mt-4">
                <x-label for="name" value="{{ __('Assigned To:') }}" />
                <x-label for="name" value=" " x-text="name" />
                <x-label class="mt-2" for="name" value="{{ __('Reassign To') }}" />
                <select wire:model="specialist" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm" >
                @forelse($specialists as $id => $name)
                    <option x-bind:selected="id === {{$id}}" id="{{$id}}" value="{{$id}}" >{{$name}}</option>
                @empty
                    <option disabled selected value="0">No Specialist</option>
                @endforelse
                </select>
            </div>
            </template>

            <template x-if="mode === 'status'">
            <div class="mt-4">
                <div class="flex flex-row items-center">
                    <x-label for="status" value="{{ __('Current Status:') }}" />
                    <template x-if="status === 'unresolved'">
                        <span class="inline-block w-3 h-3 rounded-full ml-2 bg-red-500"></span>
                    </template>
                    <template x-if="status === 'in_progress'">
                        <span class="inline-block w-3 h-3 rounded-full ml-2 bg-yellow-400"></span>
                    </template>
                    <template x-if="status === 'escalated'">
                        <span class="inline-block w-3 h-3 rounded-full ml-2 bg-blue-500"></span>
                    </template>
                    <template x-if="status === 'completed'">
                        <span class="inline-block w-3 h-3 rounded-full ml-2 bg-green-500"></span>
                    </template>
                </div>
                <div>
                    <template x-if="status === 'unresolved'">
                        <x-label for="status" value="Unresolved" />
                    </template>
                    <template x-if="status === 'in_progress'">
                        <x-label for="status" value="In Progress" />
                    </template>
                    <template x-if="status === 'escalated'">
                        <x-label for="status" value="On Hold" />
                    </template>
                    <template x-if="status === 'completed'">
                        <x-label for="status" value="Solved" />
                    </template>
                </div>
                <x-label class="mt-2" for="status" value="{{ __('Change Status') }}" />
                <select wire:model="status" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm" >
                    <option value="0" selected disabled>Select Status</option>
                    <option value="unresolved">Unresolved</option>
                    <option value="in_progress">In Progress</option>
                    <option value="escalated">On Hold</option>
                    <option value="completed">Solved</option>
                </select>
                </div>
            </template>

            <template x-if="mode === 'resend'">
            </template>

            <template x-if="mode === 'attachment'">
                <div>
                <template x-if="attachments.length >= 1">
                    <ul class="list-disc pl-5 space-y-1">
                        <template x-for="(path, index) in attachments" :key="index">
                            <li>
                                <a
                                    :href="`/storage/${path}`"
                                    target="_blank"
                                    class="text-indigo-600 underline"
                                    x-text="path.split('/').pop()"
                                ></a>
                            </li>
                        </template>
                    </ul>
                </template>
                <template x-if="!attachments.length">
                    <div>
                        <p class="text-black dark:text-white">No attachments</p>
                    </div>
                </template>
                <div>
            </template>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="show = !show" >
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" @click="$wire.routeSave(id, specialist, title, status); show = !show;"  >
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
</div>