<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class SpecialistList extends Component
{
    
   
    public $specialists;
    public $name;
    public $email;

    protected $rules = [
        "name"=> "required|min:8|max:50",
        "email"=> "required|email|unique:users|max:50",
    ];
    public function deleteSpecialist($id){
        $specialist = User::find($id);
        request()->session()->flash("success","Deleted Specialist Successfully!");
        $specialist->delete();
        $this->dispatch('specialist-deleted');
    }
   public function editSpecialist($id){
        $this->validate();

        $specialist = User::find($id);
        $specialist->name = $this->specialists[$id]->name;
        $specialist->email = $this->specialists[$id]->email;
        $specialist->save();

        request()->session()->flash('success','Specialist Edited Successfully!');
    } 
    
    public function mount(){

        $this->specialists = User::all()->sortBy("created_at");
        
    }
     #[On("specialist-created")]
    public function render()
    {
        return view('livewire.specialist-list');
    }
}
