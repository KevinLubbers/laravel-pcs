<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use App\Models\Division;
use App\Models\CarModel;

use Livewire\Component;

class EditModal extends Component
{
    public $specialists;
    public $id;
    public $name;
    public $specialist;
    public $type;
    public $isOpen;


    

    public function editModel($id, $name, $specialist){
       $model = CarModel::findOrFail($id); 
       $model->name = $name;
       
       if($model->specialist_id != "" && $model->specialist_id != 0){
        $model->specialist_id = $specialist;
       }
       else{
        $model->specialist_id = 0;
       }
       dd($model->specialist_id, $specialist);
       $model->save();
       request()->session()->flash('success', $model->name . ' Updated Successfully!');
       $this->dispatch('model-edited');
    }
    public function editDivision($id, $name, $specialist){
        $division = Division::findOrFail($id);
        $division->name = $name;
        if(!is_null($division->specialist_id)){
            $division->specialist_id = $specialist;
        }
        else{
            $division->specialist_id = 0;
        }
        $division->save();
        request()->session()->flash('success', $division->name .' Updated Successfully!');
        $this->dispatch('division-edited');
    }

    public function checkEdit($id, $name, $specialist, $title){
        if ($title === 'Edit Model'){
            $this->editModel($id, $name, $specialist);
        }
        if ($title === 'Edit Division'){
            $this->editDivision($id, $name, $specialist);
        }
    }

    public function mount(){
        
        $this->specialists = User::pluck( 'name','id')->all();
        $this->isOpen = false;
    }
    public function render()
    {
        return <<<'HTML'
        <div>
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded relative dark:text-green-300 dark:border-green-600 dark:bg-green-900">
                {{session('success')}}
            </div>
        @endif
        <div x-data="{show: $wire.entangle('isOpen'), id: '', name: '', specialist: '', title: '' }" x-show="show" 
        @edit-division.window="show = !show, id = $event.detail.id, name = $event.detail.name, specialist = $event.detail.specialist, title = $event.detail.title"
        @edit-model.window="show = !show, id = $event.detail.id, name = $event.detail.name, specialist = $event.detail.specialist, title = $event.detail.title"  > 
            <x-dialog-modal>
                <x-slot name="title">
                    <div x-text="title">{{ __('Edit') }}</div>
                </x-slot>

                <x-slot name="content">
                    <div class="mt-4">
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input x-data={} @edit-division.window="$nextTick(() => $refs.namecheck.focus())"
                        @edit-model.window="$nextTick(() => $refs.namecheck.focus())" x-model="name" x-ref="namecheck" type="text" name="name" id="name" autocomplete="off" />
                        <x-label for="id" value="{{ __('Assign Specialist') }}" />
                        <select  x-model="specialist" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                            <option disabled selected value="0">Select Specialist</option>
                            <option selected value="0">No Specialist</option>
                            @foreach($specialists as $id => $name)
                                <option id="specialist_id" name="specialist_id" id="{{$id}}" value="{{$id}}" >{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </x-slot>

                <x-slot name="footer">
                    <x-secondary-button @click="show = !show" >
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-button class="ml-3" @click="$wire.checkEdit(id, name, specialist, title); show = !show;"  >
                        {{ __('Save') }}
                    </x-button>
                </x-slot>
            </x-dialog-modal>
        </div>
        </div>
        HTML;
    }
}
