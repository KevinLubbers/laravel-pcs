<?php

use App\Models\User;
use Livewire\Attributes\On;
use App\Models\Division;
use App\Models\CarModel;
use Livewire\Volt\Component;

new class extends Component {
    
    public $showMe;
    public $specialists;
    public $id;
    public $name;
    public $specialist;
    public $type;


    

    public function reassignSpecialist($id, $specialist){

       
       request()->session()->flash('success', $model->name . ' Updated Successfully!');
       $this->dispatch('model-edited');
    }
    public function changeStatus($id, $status){
        
    }
    public function resendTicket($id){
        
    }


    public function routeSave($id, $specialist, $title, $status = null){
        switch ($title) {
            case 'Reassign Specialist':
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
<div x-data="{ show: @entangle('showMe'), id:'', attachments:[], title: '', name: '', mode: '', status: '' }" x-show="show"
    @reassign.window="show = !show, id = $event.detail.id, mode = $event.detail.mode, name = $event.detail.name, title = $event.detail.title"
    @attachment.window="show = !show, id = $event.detail.id, mode = $event.detail.mode, title = $event.detail.title"
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
                <select class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm" >
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