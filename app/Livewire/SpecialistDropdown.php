<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use App\Models\User;
use Livewire\Component;

class SpecialistDropdown extends Component
{
    public $specialists;
  
    public function render()
    {

        $this->specialists = User::all()->sortBy('created_at');
        return view('livewire.specialist-dropdown', [
            'specialists' => $this->specialists
        ]);
    }
}
