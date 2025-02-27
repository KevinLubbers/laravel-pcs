<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <x-label for="email" value="{{ __('Email') }}" />
    <x-input id="email" class="" type="email" name="email" :value="old('email')" required autofocus autocomplete="off" />

    <x-label for="task" value="{{ __('Task') }}" />
    <select class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
        <option value="" selected disabled>Select Task</option>
    </select>

    <x-label for="year" value="{{ __('Year') }}" />
    <select class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
        <option value="" selected disabled>Select Year</option>
    </select>

    <x-label for="division" value="{{ __('Division') }}" />
    <select class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
        <option value="" selected disabled>Select Division</option>
    </select>

    <x-label for="model" value="{{ __('Model') }}" />
    <select class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
        <option value="" selected disabled>Select Model</option>
    </select>

    <x-label for="trim" value="{{ __('Trim / Packages / Drivetrain') }}" />
    <x-input type="text" name="trim" id="trim" autocomplete="off" />

    <x-label for="information" value="{{ __('Customer / Vehicle Information') }}" />
    <div style="align-items:baseline;" class="flex flex-row">
        <div class="mr-2 "><x-checkbox id="customer" name="customer" value="customer" /></div>
        <div><x-label for="customer" value="{{ __('Customer Number') }}" /></div>
    </div>
    <div style="align-items:baseline;" class="flex flex-row">
        <div class="mr-2"><x-checkbox id="fo" name="fo" value="fo" /></div>
        <div><x-label for="fo" value="{{ __('FO Number') }}" /></div>
    </div>
    <x-input type="text" name="information" id="information" autocomplete="off" />

    <x-label for="description" value="{{ __('Description of Issue') }}" />
    <textarea class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm" name="description" id="description" autocomplete="off" ></textarea>

    <input type="file" multiple="multiple" name="file" id="file" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">

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
