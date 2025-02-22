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

    public function mount(){
        $this->specialists = User::pluck( 'name')->all();
        $this->divisions = Division::pluck( 'name')->all();
        $this->models = CarModel::pluck( 'name')->all();
    }


    public function placeholder(){
        return <<<'blade'
            <div class="pl-4 mt-1 block mb-2 rounded-md text-gray-600 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
            <circle cx="25" cy="25" r="20" stroke="#ddd" stroke-width="5" fill="none" />
            <circle cx="25" cy="25" r="20" stroke="#2d7356" stroke-width="5" stroke-linecap="round" fill="none" stroke-dasharray="126" stroke-dashoffset="30">
            <animate attributeName="stroke-dashoffset" from="126" to="0" dur="1.5s" repeatCount="indefinite" />
            </circle>
            </svg>
            <div>

        blade;
    }
    #[On(event: "model-created")]
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


            return <<<'blade'
                <div class="pl-4 mt-1 block mb-2 rounded-md text-gray-600 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                
                    <div class="flex flex-col">
                        
                        @forelse($divisions as $division)
                
                        
                            <div><u><b>{{$division->name}}</u></b>&nbsp;</div>
                            <div>├───&nbsp;<i>{{$division->users->name ?? 'No Specialist'}}</i></div>
                    
                            @forelse($division->models as $model)
                                <div>├──────────────────&nbsp;{{$model->name}}</div>
                            @empty
                                <div>├&nbsp;<small>No models found</small></div>
                            @endforelse
                          
                        @empty
                            <div>├&nbsp;<small>No divisions found</small></div>
                        @endforelse
                    </div>
                </div>
            blade;
    }
}
