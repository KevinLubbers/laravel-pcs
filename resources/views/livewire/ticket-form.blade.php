<?php

use Livewire\Volt\Component;
use App\Models\TicketTask;
use App\Models\Division;
use App\Models\CarModel;
use App\Models\Ticket;

new class extends Component {
    public $email;
    public $specialist;
    public $tasks;
    public $task;
    public $year;
    public $divisions = [];
    public $division;
    public $models = [];
    public $model;
    public $misc;
    public $info_type;
    public $info_number;
    public $details;
    public $status;
    
    public function determineSpecialist()
{
    if ($this->task) {
        $specialist = TicketTask::find($this->task)?->specialist_id;
        if ($specialist) {
            return $specialist;
        }
    }

    if ($this->division) {
        $specialist = Division::find($this->division)?->specialist_id;
        if ($specialist) {
            return $specialist;
        }
    }

    if ($this->model) {
        $specialist = CarModel::find($this->model)?->specialist_id;
        if ($specialist) {
            return $specialist;
        }
    }

    return null;
}

    public function create(){
    $this->validate([
        'email' => [
            'required',
            'email',
            'regex:/^[^@]+@(militarycars|intlauto|mymilitarycars)\.com$/',
        ],
        'task' => 'required|exists:tasks,id',
        'year' => 'required|integer|min:2020|max:3000',
        'division' => 'required|exists:divisions,id',
        'model' => 'required|exists:car_models,id',
        'misc' => 'required|string|min:1|max:100',
        'info_type' => 'nullable|in:fo,customer',
        'info_number' => 'nullable|integer|required_with:info_type',
        'details' => 'required|string|max:5000'
	]);
    $specialistId = $this->determineSpecialist();
    $new = Ticket::create([
        "email" => $this->email,
        "specialist_id" => $specialistId,
        'task_id' => $this->task,
        'year' => $this->year,
        'division_id' => $this->division,
        'model_id' => $this->model,
        'misc' => $this->misc,
        'info_type' => $this->info_type,
        'info_number' => $this->info_number,
        'details' => $this->details 
    ]);
    $this->reset();
    $this->dispatch('ticket-created', ticket: $new);
    session()->flash('success','Ticket Created Successfully!');
    return redirect()->to('/');
	}
    public function mount(){
        $this->tasks = TicketTask::all();
        $this->year = date('Y');
        $this->divisions = Division::all();
    }
    public function changedDivision($divisionId) {
	    $this->models = CarModel::where('division_id', $divisionId)->get();
	    $this->model = null;
    }
}; ?>

<form wire:submit.prevent="create">
<div>
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded relative dark:text-green-300 dark:border-green-600 dark:bg-green-900">{{session('success')}}</div>
    @endif
    <x-label for="email" value="{{ __('Email') }}" />
    <x-input wire:model="email" class="rounded-md dark:bg-gray-800" id="email" type="email" name="email" required autofocus autocomplete="off" />
    @error('email')
        <p class="text-red-400 text-xs mt-2 mb-2">{{$message}}</p>
    @enderror

    <x-label class="mt-4" for="task" value="{{ __('Task') }}" />
    <select wire:model="task" style="" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
        <option value="0" selected disabled>Select Task</option>
        @forelse($tasks ?? [] as $task)
            <option value="{{$task->id}}">{{$task->name}}</option>
        @empty
            <option value="0">No Tasks</option>
        @endforelse
    </select>
    @error('task')
        <p class="text-red-400 text-xs mt-2 mb-2">{{$message}}</p>
    @enderror

    <x-label class="mt-4" for="year" value="{{ __('Year') }}" />
    <select style="" wire:model.defer="year" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
        <option value="0" selected disabled>Select Year</option>
        @foreach(range(now()->year - 1, now()->year + 2) as $y)
            <option value="{{ $y }}">{{ $y }}</option>
        @endforeach
    </select>
    @error('year')
        <p class="text-red-400 text-xs mt-2 mb-2">{{$message}}</p>
    @enderror

    <x-label class="mt-4" for="division" value="{{ __('Division') }}" />
    <select wire:model="division" wire:change="changedDivision($event.target.value)" style="" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
        <option value="0" selected disabled>Select Division</option>
        @forelse($divisions ?? [] as $division)
            <option value="{{$division->id}}">{{$division->name}}</option>
        @empty
            <option value="0">No Divisions</option>
        @endforelse
    </select>
    @error('division')
        <p class="text-red-400 text-xs mt-2 mb-2">{{$message}}</p>
    @enderror

    <x-label class="mt-4" for="model" value="{{ __('Model') }}" />
    <select wire:model="model" style="" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
        <option value="0" selected disabled>Select Model after Division</option>
	@forelse($models ?? [] as $model)
		<option value="{{$model->id}}">{{$model->name}}</option>
	@empty
        <option value="0">No Models - Please Select A Division</option>
	@endforelse
    </select>
    @error('model')
        <p class="text-red-400 text-xs mt-2 mb-2">{{$message}}</p>
    @enderror

    <x-label class="mt-4" for="misc" value="{{ __('Trim / Packages / Drivetrain') }}" />
    <x-input wire:model="misc" style="" placeholder="Texas Trail 4x4" type="text" name="misc" id="misc" autocomplete="off" />
    @error('misc')
        <p class="text-red-400 text-xs mt-2 mb-2">{{$message}}</p>
    @enderror

    <div x-data="{selected_box: $wire.entangle('info_type')}">
        <x-label class="mt-4" for="information" value="{{ __('Customer / Vehicle Information') }}" />
        <div style="align-items:baseline;" class="flex flex-row">
            <div class="mr-2 ">
                <x-checkbox x-bind:checked="selected_box === 'customer'"
                x-on:click="selected_box='customer'" id="customer" name="customer" value="customer" />
            </div>
            <div><x-label for="customer" value="{{ __('Customer Number') }}" /></div>
        </div>
        <div style="align-items:baseline;" class="flex flex-row">
            <div class="mr-2">
                <x-checkbox x-bind:checked="selected_box === 'fo'"
                x-on:click=" selected_box='fo'" id="fo" name="fo" value="fo" />
            </div>
            <div><x-label for="fo" value="{{ __('FO Number') }}" /></div>
        </div>
    </div>
    @error('info_type')
        <p class="text-red-400 text-xs mt-2 mb-2">{{$message}}</p>
    @enderror
    <x-input wire:model="info_number" style="" type="text" name="information" id="information" autocomplete="off" />
    @error('info_number')
        <p class="text-red-400 text-xs mt-2 mb-2">{{$message}}</p>
    @enderror

    <x-label class="mt-4" for="description" value="{{ __('Description of Issue') }}" />
    <textarea wire:model="details" style="" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm" name="description" id="description" autocomplete="off" ></textarea>
    @error('details')
        <p class="text-red-400 text-xs mt-2 mb-2">{{$message}}</p>
    @enderror

    <input wire:model="attachments" type="file" multiple="multiple" name="file" id="file" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">

    <x-button class="mt-4" type="submit">
        {{ __('Send') }}
    </x-button>

<style>
    
    input::file-selector-button{
        color:white;
        background-color: rgb(55, 65, 81);
        border: 1px solid rgb(55, 65, 81);
    }

    input::file-selector-button:hover{
        cursor: pointer;
    }
</style>
</div>
</form>