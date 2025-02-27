<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;

use Livewire\Component;

class EditModal extends Component
{
    public $specialists;
    public $showModal = true;


    #[On("edit-specialist")]
    #[On("edit-model")]
    public function show(){
       
        $this->showModal = !$this->showModal;
    }

    public function editSpecialist($id){
        
    }

    public function mount(){
        
        $this->specialists = User::pluck( 'name','id')->all();
    }
    public function render()
    {
        return <<<'blade'
        <div> 
            <x-dialog-modal wire:model="showModal">
                <x-slot name="title">
                    {{ __('Edit Specialist') }}
                </x-slot>

                <x-slot name="content">
                    <div class="mt-4">
                        <x-label for="specialist_id" value="{{ __('Assign Specialist') }}" />
                        <select class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                            <option disabled selected value="null">Select Specialist</option>
                            @foreach($specialists as $id => $name)
                                <option id="specialist_id" name="specialist_id" id="{{$id}}" value="{{$id}}" >{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </x-slot>

                <x-slot name="footer">
                    <x-secondary-button @click="{show = false}" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-button class="ml-3" wire:click="" wire:loading.attr="disabled">
                        {{ __('Save') }}
                    </x-button>
                </x-slot>
            </x-dialog-modal>
        </div>
        blade;
    }
}
