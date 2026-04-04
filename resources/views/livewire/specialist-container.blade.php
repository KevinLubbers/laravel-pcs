<div>
    @if(session('error'))
        <div class="mb-4 bg-red-200 border border-red-300 text-red-800 px-4 py-3 rounded relative dark:text-red-300 dark:border-red-600 dark:bg-red-900">
            {{session('error')}}
        </div>
    @endif
    @foreach($specialists as $specialist)
        @include('livewire.specialist-row', 
        [
            'specialist' => $specialist
        ])

    @endforeach
</div>
