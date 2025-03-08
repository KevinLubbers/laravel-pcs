<?php

use Livewire\Volt\Component;
use App\Models\TicketTask;
use App\Models\Division;

new class extends Component {
    public $email;
    public $specialist;
    public $tasks;
    public $task;
    public $year;
    public $divisions;
    public $division;
    public $model;
    public $misc;
    public $info_type;
    public $info_number;
    public $details;
    public $attachments;
    public $status;
    

    public function mount(){
        $this->tasks = TicketTask::all();
        $this->year = date('Y');
        $this->divisions = Division::all();
    }
    
}; ?>

<div>
    <x-label for="email" value="{{ __('Email') }}" />
    <x-input wire:model="email" class="dark:bg-gray-800" id="email" type="email" name="email" required autofocus autocomplete="off" />

    <x-label class="mt-4" for="task" value="{{ __('Task') }}" />
    <select wire:model="task" style="" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
        <option value="0" selected disabled>Select Task</option>
        @forelse($tasks as $task)
        <option value="{{$task->id}}">{{$task->name}}</option>
        @empty
        <option value="0">No Tasks</option>
        @endforelse
    </select>

    <x-label class="mt-4" for="year" value="{{ __('Year') }}" />
    <select style="" wire:model="year" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
        <option value="0" selected disabled>Select Year</option>
        <option value="{{($year - 1)}}">{{$year - 1}}</option>
        <option value="{{$year}}">{{$year}}</option>
        <option value="{{($year + 1)}}">{{$year + 1}}</option>
        <option value="{{($year + 2)}}">{{$year + 2}}</option>
    </select>

    <x-label class="mt-4" for="division" value="{{ __('Division') }}" />
    <select wire:model="division" style="" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
        <option value="0" selected disabled>Select Division</option>
        @forelse($divisions as $division)
        <option value="{{$division->id}}">{{$division->name}}</option>
        @empty
        <option value="0">No Divisions</option>
        @endforelse
    </select>

    <x-label class="mt-4" for="model" value="{{ __('Model') }}" />
    <select wire:model="model" style="" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
        <option value="" selected disabled>Select Model</option>
    </select>

    <x-label class="mt-4" for="misc" value="{{ __('Trim / Packages / Drivetrain') }}" />
    <x-input wire:model="misc" style="" placeholder="Texas Trail 4x4" type="text" name="misc" id="misc" autocomplete="off" />

    <x-label class="mt-4" for="information" value="{{ __('Customer / Vehicle Information') }}" />
    <div style="align-items:baseline;" class="flex flex-row">
        <div class="mr-2 "><x-checkbox id="customer" name="customer" value="customer" /></div>
        <div><x-label for="customer" value="{{ __('Customer Number') }}" /></div>
    </div>
    <div style="align-items:baseline;" class="flex flex-row">
        <div class="mr-2"><x-checkbox id="fo" name="fo" value="fo" /></div>
        <div><x-label for="fo" value="{{ __('FO Number') }}" /></div>
    </div>
    <x-input wire:model="info_number" style="" type="text" name="information" id="information" autocomplete="off" />

    <x-label class="mt-4" for="description" value="{{ __('Description of Issue') }}" />
    <textarea wire:model="details" style="" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm" name="description" id="description" autocomplete="off" ></textarea>

    <input wire:model="attachments" type="file" multiple="multiple" name="file" id="file" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">

    <x-button class="mt-4" wire:click="create">
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
