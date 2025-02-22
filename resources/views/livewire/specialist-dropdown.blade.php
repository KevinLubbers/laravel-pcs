<div>
<x-label for="specialist_id" value="{{ __('Assign Specialist -(Optional)-') }}" />
        <select   class="mt-1 block mb-2 rounded-md   border-gray-300">
            <option disabled selected value="">Select Specialist</option>
            @foreach($specialists as $id => $name)
            
                <option id="specialist_id" name="specialist_id" wire:model="specialist_id" wire:key="{{$unique_id}}" id="{{$id}}" value="{{$id}}" >{{$name}}</option>
            @endforeach
        </select>
        
</div>