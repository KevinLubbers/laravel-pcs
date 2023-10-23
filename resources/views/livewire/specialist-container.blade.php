<div>
    @foreach($specialists as $specialist)
        @include('livewire.specialist-row', 
        [
            'specialist' => $specialist
        ])
    @endforeach
</div>
