<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use App\Models\User;
use Livewire\Component;

class SpecialistContainer extends Component
{
    public $specialists;
    public $email;
    public $name;
    public function containerCheck(){
        return true;
    }

   
    #[On("edited-name")]
    public function editName($id, $name){

        $this->name = $name;
        $this->validate([ 'name' => 'required|min:8|max:50']);
        User::where("id", $id)->update(["name"=> $name]);
    }
    #[On("edited-email")]
    public function editEmail($id, $email){
        $this->email = $email;
        $this->validate(['email' => 'required|email|unique:users|max:50']);
        User::where("id", $id)->update(["email"=> $email]);
    }
    public function deleteSpecialist($id){
        $specialist = User::findOrFail($id);
        $specialist->delete();
    }

    #[On("specialist-created")]
    public function render()
    {
        $this->specialists = User::all()->sortBy('created_at');
        return view('livewire.specialist-container', [
            'specialists' => $this->specialists
        ]);
    }
}
