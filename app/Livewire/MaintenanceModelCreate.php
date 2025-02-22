<?php

namespace App\Livewire;

use App\Rules\Validate;
use App\Models\User;
use App\Models\CarModel;
use App\Models\Division;
use Livewire\Component;
use Livewire\Attributes\On;

class MaintenanceModelCreate extends Component
{
    public $name;
    public $specialist_id = null;
    
     
    public $division_id = null;

    public function createModel(){
        $this->validate([
            "name"=> "required|min:3|max:50",
            "specialist_id"=> "nullable|integer",
            "division_id"=> "required|integer",
        ], [
            'division_id.required' => 'Please select a division from the dropdown',
        ]);
        $new = CarModel::create([
            'name' => $this->name,
            'specialist_id'=> $this->specialist_id,
            'division_id'=> $this->division_id,
        ]);
        $this->reset(['name','specialist_id','division_id']);
        $this->dispatch('model-created', model: $new);
        request()->session()->flash('success','Model Created Successfully!');
    }
    #[On("division-created")]
    public function render()
    {
        $specialists = User::pluck( 'name','id')->all();
        $divisions = Division::pluck( 'name','id')->all();
        return view('livewire.maintenance-model-create', [
            'specialists' => $specialists,
            'divisions' => $divisions
        ]);
    }
}
