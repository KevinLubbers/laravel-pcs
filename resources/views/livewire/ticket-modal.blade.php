<?php

use App\Models\User;
use Livewire\Attributes\On;
use App\Models\Division;
use App\Models\CarModel;
use Livewire\Volt\Component;

new class extends Component {
    
    public $showMe = false;
    public $specialists;
    public $id;
    public $name;
    public $specialist;
    public $type;


    

    public function editModel($id, $name, $specialist){
        //dd($id, $name, $specialist);

       $model = CarModel::findOrFail($id); 
       $model->name = $name;
       
       $model->specialist_id = $specialist;
       /**if($model->specialist_id != "" && $model->specialist_id != 0 && $model->specialist_id != null){
        $model->specialist_id = $specialist;
       }
       else{
        $model->specialist_id = 0;
       }**/
       //dd($model->specialist_id, $specialist);
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

}; ?>

<div x-cloak x-transition x-data="{ show: @entangle('showMe') }"
    @reassign.window="show = !show" @attachment.window="show = !show"
    @status.window="show = !show" @resend.window="show = !show" x-show="show">
    <x-dialog-modal>
        <x-slot name="title">
            <div >{{ __('Edit') }}</div>
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-label for="id" value="{{ __('Assign Specialist') }}" />
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