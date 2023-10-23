<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class SpecialistCreate extends Component
{
    public $name;
    public $email;
    public function createSpecialist(){
        $this->validate([
            "name"=> "required|min:8|max:50",
            "email"=> "required|email|unique:users",
        ]);
        request()->session()->flash('success','Specialist Created Successfully!');
        $new = User::create([
            'name' => $this->name,
            'email'=> $this->email,
            'password'=> Hash::make('password'),
        ]);
        $this->reset(['name','email']);
        $this->dispatch('specialist-created', specialist: $new);
        
    }
     
    public function render()
    {
        return view('livewire.specialist-create');
    }
}
