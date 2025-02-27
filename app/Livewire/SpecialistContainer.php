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

   
    #[On(event: "edited-name")]
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

    #[On("specialist-created")]
    public function render()
    {
        $this->specialists = User::all()->sortBy('created_at');
        return view('livewire.specialist-container', [
            'specialists' => $this->specialists
        ]);
    }
}
