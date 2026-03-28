<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Division;
use Livewire\Attributes\On;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
class MaintenanceDivCreate extends Component
{
    public $name;
    public $specialist_id = null;
    public function createDivision(){
        if (Gate::denies('make-changes')) {
            session()->flash('error', 'Demo users cannot make changes.');
            return;
        }
        $this->validate([
            "name"=> "required|min:3|max:50",
            "specialist_id"=> "nullable|integer",
        ]);
        $new = Division::create([
            'name' => $this->name,
            'specialist_id'=> $this->specialist_id,
        ]);
        $this->reset(['name','specialist_id']);
        $this->dispatch('division-created', division: $new);
        request()->session()->flash('success','Division Created Successfully!');

    }
    public function render()
    {

        $specialists = User::pluck( 'name','id')->all();
        return view('livewire.maintenance-div-create', [
            'specialists' => $specialists
        ]);
    }
}
