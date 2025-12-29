<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Attribute\Rule;
use Livewire\Attribute\Reactive;
use App\Models\TicketTask;
use App\Models\User;
use Livewire\Component;

class TaskList extends Component
{
    
    public $tasks;
    public $specialists;
    

    public $unlocked = "imgs/unlocked.png";
    public $locked = "imgs/locked.png";
    public $dark= 'imgs/edit-dark.png';
    public $light = 'imgs/edit-light.png';
    public $dDark = 'imgs/delete-dark.png';
    public $dLight = 'imgs/delete-light.png';
    public function __construct() {
        $this->tasks = TicketTask::select('id','name', 'specialist_id', 'cc_id')->with(['specialist:id,name','cc:id,name'])->get();
        $this->specialists = User::pluck('name','id')->all();
    }
    public function delete($id){
        $task = TicketTask::findOrFail($id);
        $task->delete();
        $this->dispatch('task-deleted')->to(TaskList::class);
        
    }
    #[On("edited-task-specialist")]
    public function updateSpecialist($id, $specialist){
        $task = TicketTask::find($id);
        $task->specialist_id = $specialist;
        $task->save();
        request()->session()->flash('success', 'Task Specialist Successfully Updated!');
    }
    #[On("edited-task-cc")]
    public function updateCc($id, $cc){
        $task = TicketTask::find($id);
        $task->cc_id = $cc;
        $task->save();
        request()->session()->flash('success', 'Task CC Successfully Updated!');
    }
    #[On("edited-task-name")]
    public function update($id, $name){
        $task = TicketTask::find($id);
        $task->name = $name;
        $task->save();
        request()->session()->flash('success', 'Task Name Successfully Updated!<br>Name: '. $task->name);
    }
    #[On("task-created")]
    public function mount(){
        $this->tasks = TicketTask::select('id','name', 'specialist_id', 'cc_id')->with(['specialist:id,name','cc:id,name'])->get();
        $this->specialists = User::pluck('name','id')->all();
    }

    public function placeholder(){
        return <<<'HTML'
            <div class="pl-4 mt-1 block mb-2 rounded-md text-gray-600 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
            <circle cx="25" cy="25" r="20" stroke="#ddd" stroke-width="5" fill="none" />
            <circle cx="25" cy="25" r="20" stroke="#2d7356" stroke-width="5" stroke-linecap="round" fill="none" stroke-dasharray="126" stroke-dashoffset="30">
            <animate attributeName="stroke-dashoffset" from="126" to="0" dur="1.5s" repeatCount="indefinite" />
            </circle>
            </svg>
            <div>

        HTML;
    }
    #[On("task-deleted")]
    public function render()
    {

        return <<<'HTML'
        <div >
        @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded relative dark:text-green-300 dark:border-green-600 dark:bg-green-900">{!!session('success')!!}</div>
        @endif
        @forelse($tasks as $task)
        <div wire:key="task-{{$task->id}}" class="flex flex-row flex-wrap gap-6 justify-between p-6 items-center" x-data="{unlockClicked: false, deleteClicked: false, taskId: '{{$task->id}}', specialist: '{{$task->specialist_id}}', cc: '{{$task->cc_id}}'}">
            <div class="flex flex-col w-full">
                <div x-show="showMe" x-data="{ showMe: true, id: '{{$task->id}}', name: '{{$task->name}}' }"  class="flex flex-row items-center w-full" >
                    <div class="flex flex-col w-full">
                        <x-label for="name" value="{{ __('Task Name') }}" class="mb-2" />
                        <x-input x-ref="input" x-init="$watch('name', value => $dispatch('edited-task-name', {id: id, name: name}))" x-model.debounce.1500ms="name"  id="name{{$task->id}}"  type="text" class="block w-full" x-bind:disabled="!unlockClicked" />
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="flex flex-row mt-4">
                            <img @click="unlockClicked = !unlockClicked; $nextTick(() => $refs.input.focus());" height="32px" width="32px" class="mr-1 cursor-pointer" :src="!darkMode ? '{{url($light)}}' : '{{url($dark)}}'" >
                            <img @click="deleteClicked = !deleteClicked" wire:click="delete({{$task->id}})" wire:confirm="Are you sure you want to DELETE - {{$task->name}}?" @wire:confirm="showMe = false" height="32px" width="32px" class="mr-1 cursor-pointer" :src="!darkMode ? '{{url($dLight)}}' : '{{url($dDark)}}'" >
                        </div>

                    </div>

                </div>

            </div>

            <div>
                <x-label for="specialist_id" value="{{ __('Assigned Specialist') }}" />
                    <select x-model="specialist"  x-init="$watch('specialist', value => $dispatch('edited-task-specialist', {id: taskId, specialist: specialist}))"  x-bind:disabled="!unlockClicked"  class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                        <option disabled value="0">Select Specialist</option>
                        @empty($task->cc_id)
                        <option selected value="0">No Specialist</option>
                        @else
                        <option value="0">No Specialist</option>
                        @endempty
                        @foreach($specialists as $id => $name)
                            @if($task->specialist_id == $id)
                            <option selected wire:key="spec-{{$id}}" id="spec-{{$id}}" value="{{$id}}" >{{$name}}</option>
                            @else
                            <option wire:key="spec-{{$id}}" id="spec-{{$id}}" value="{{$id}}" >{{$name}}</option>
                            @endif
                        @endforeach
                    </select>
            </div>
 
            <div>
                <x-label for="specialist_id" value="{{ __('Assigned CC Specialist') }}" />
                <select x-model="cc" x-init="$watch('cc', value => $dispatch('edited-task-cc', {id: taskId, cc: cc}))"  x-bind:disabled="!unlockClicked" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                    <option disabled value="0">Select Specialist</option>
                    @empty($task->cc_id)
                    <option selected value="0">No Specialist</option>
                    @else
                    <option value="0">No Specialist</option>
                    @endempty
                    @foreach($specialists as $id => $name)
                        @if($task->cc_id == $id)
                        <option  selected wire:key="cc-{{$id}}" id="cc-{{$id}}" value="{{$id}}" >{{$name}}</option>
                        @else 
                        <option wire:key="cc-{{$id}}" id="cc-{{$id}}" value="{{$id}}" >{{$name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <hr>
        </div>
        @empty
        @endforelse
        </div>
        HTML;
    }
}
