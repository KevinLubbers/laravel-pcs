<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Division;
use App\Models\CarModel;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class MaintenanceList extends Component
{
    use WithPagination;
    public $divisions;
    public $specialists;
    
    public $dark= 'imgs/edit-dark.png';
    public $light = 'imgs/edit-light.png';
    public $dDark = 'imgs/delete-dark.png';
    public $dLight = 'imgs/delete-light.png';


    public function mount(){
        $this->specialists = User::pluck( 'name', 'id')->all();
    }

    public function deleteModel($id){
        $model = CarModel::find($id);
        $model->delete();
        request()->session()->flash('success',$model->name .' Deleted Successfully!');
        $this->dispatch('model-deleted', model: $model);
    }

    public function deleteSpecialist($id){
        $division= Division::find($id);
        $division->specialist_id = null;
        $division->save();
        request()->session()->flash('success','Specialist Deleted Successfully from '. $division->name . ' Division!');
    }

    public function deleteDivision($id){
        $division= Division::find($id);
        $division->delete();
        request()->session()->flash('success','Division Deleted Successfully!');
    }

    public function editSpecialist($id){
         
    }
    public function editDivision($id){
        
    }
    public function placeholder(){
        return <<<'HTML'
            <div class="pl-4 mt-1 mb-2 rounded-md text-gray-600 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
            <circle cx="25" cy="25" r="20" stroke="#ddd" stroke-width="5" fill="none" />
            <circle cx="25" cy="25" r="20" stroke="#2d7356" stroke-width="5" stroke-linecap="round" fill="none" stroke-dasharray="126" stroke-dashoffset="30">
            <animate attributeName="stroke-dashoffset" from="126" to="0" dur="1.5s" repeatCount="indefinite" />
            </circle>
            </svg>
            <div>

        HTML;
    }
    #[On(event: "model-created")]
    #[On(event: "model-edited")]
    #[On(event: "division-created")]
    #[On(event: "division-edited")]
    public function render()
    {
        /* WRONG WAY TO DO IT
        $specialists = User::pluck( 'name')->all();
        $divisions = Division::pluck( 'name')->all();
        $models = CarModel::pluck( 'name')->all();

        return view('livewire.maintenance-list', [
            'specialists' => $specialists,
            'divisions' => $divisions,
            'models' => $models
        ]);
           WRONG WAY TO DO IT*/

        /*
        $this->divisions = Division::select('id', 'name', 'specialist_id')
        ->with(['users:id,name', 'models:id,name,division_id'])
        ->get();
        */
        $this->divisions = Division::select('id', 'name', 'specialist_id')
        ->with('users:id,name') // No pagination for users
        ->get();

        foreach ($this->divisions as $division) {
            $division->models = $division->models()->select('id', 'name', 'division_id')->paginate(10);
        }


            return <<<'HTML'
                <div class="pl-4 mt-1 block mb-2 rounded-md text-gray-600 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded relative dark:text-green-300 dark:border-green-600 dark:bg-green-900">
                            {{session('success')}}
                        </div>
                    @endif
                    <div class="flex flex-col" x-data="{unlockClicked: false, deleteClicked: false}">
                        
                        @forelse($divisions as $division)
                
                        
                            <div class="flex flex-row items-center">
                            <div class="mr-4"><u><b>{{$division->name}}</u></b></div>

                            <div class="ml-4"><img @click="$dispatch('edit-division', {id: {{$division->id}}, name: '{{$division->name}}', specialist: '{{$division->specialist_id}}', title: 'Edit Division'})" height="16px" width="16px" class="mr-1 cursor-pointer" :src="!darkMode ? '{{url($light)}}' : '{{url($dark)}}'" ></div>
                            <div class="ml-4"><img @click="deleteClicked = !deleteClicked" wire:click="deleteDivision({{$division->id}})" wire:confirm="Are you sure you want to DELETE - {{$division->name}}?"  height="16px" width="16px" class="mr-1 cursor-pointer" :src="!darkMode ? '{{url($dLight)}}' : '{{url($dDark)}}'" ></div>
                            </div>
                            <div class="flex flex-row items-center">
                                ├───&nbsp;<i>{{$division->users->name ?? 'No Specialist'}}</i>
                                @isset($division->users->name)
                                    <img @click="deleteClicked = !deleteClicked" wire:click="deleteSpecialist({{$division->id}})" wire:confirm="Are you sure you want to DELETE - {{$division->users->name}} from {{$division->name}}?"  height="16px" width="16px" class="mr-1 ml-4 cursor-pointer" :src="!darkMode ? '{{url($dLight)}}' : '{{url($dDark)}}'" >
                                @endisset
                            </div>
                    
                            @forelse($division->models as $model)

                            


                                <div class="flex flex-row items-center">
                                    ├──────────────────&nbsp;{{$model->name}}
                                    
                                    <img @click="unlockClicked = !unlockClicked" wire:click="$dispatch('edit-model', {id: '{{$model->id}}', name: '{{$model->name}}', specialist: '{{$model->specialist_id}}', title: 'Edit Model'})" height="16px" width="16px" class="mr-2 ml-4 cursor-pointer" :src="!darkMode ? '{{url($light)}}' : '{{url($dark)}}'" >
                                    <img @click="deleteClicked = !deleteClicked" wire:click="deleteModel({{$model->id}})" wire:confirm="Are you sure you want to DELETE - {{$model->name}}"  height="16px" width="16px" class="mr-1 ml-2 cursor-pointer" :src="!darkMode ? '{{url($dLight)}}' : '{{url($dDark)}}'" >
                                </div>
                               

                            @empty
                                <div>├&nbsp;<small>No models found</small></div>
                            @endforelse
                          
                        @empty
                            <div>├&nbsp;<small>No divisions found</small></div>
                        @endforelse
                    </div>

                </div>
            HTML;
    }
}
