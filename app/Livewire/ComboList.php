<?php

namespace App\Livewire;

use Livewire\Component;

class ComboList extends Component
{
    public function placeholder(){
        return <<<'HTML'
            <div class="pl-4 mt-1  mb-2 rounded-md text-gray-600 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
            <circle cx="25" cy="25" r="20" stroke="#ddd" stroke-width="5" fill="none" />
            <circle cx="25" cy="25" r="20" stroke="#2d7356" stroke-width="5" stroke-linecap="round" fill="none" stroke-dasharray="126" stroke-dashoffset="30">
            <animate attributeName="stroke-dashoffset" from="126" to="0" dur="1.5s" repeatCount="indefinite" />
            </circle>
            </svg>
            <div>

        HTML;
    }
    public function render()
    {
        return <<<'HTML'
        <div>
            <div class="flex items-centertext-sm leading-relaxedml-3 text-xl font-semibold text-gray-900 dark:text-white">
                Specialist List:
            </div>

            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
            <!--add @ livewire tags here to generate each form / action -->
            {{--@livewire('specialist-container')--}}
            <livewire:specialist-container />
            
            </p>


            <div class="flex items-centertext-sm leading-relaxedml-3 text-xl font-semibold text-gray-900 dark:text-white">
                Task List:
            </div>
            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
            <livewire:task-list /> 
            </p>

            <p class="mt-4 text-sm">
            <!--footer / redirect--> 
            </p>
        </div>
        HTML;
    }
}
