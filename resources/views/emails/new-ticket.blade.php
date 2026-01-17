<!DOCTYPE html>
<html>
<body>
    <h1>PCS Ticket System</h1>

    <p>
        Ticket <strong>{{ $ticket->display_number }}</strong> has been created by submitting a PCS Ticket online
    </p>
    <hr class="mb-2 mt-2">

    <p><strong>Assigned To:</strong> {{ $ticket->users->name ?? "No Specialist"}}</p>
    <p><strong>Submitted By:</strong> {{ $ticket->email }}</p>
    <p><strong>Task:</strong> {{ $ticket->tasks->name ?? "No Task"}}</p>
    <hr class="mb-2 mt-2">
    <p><strong>Year:</strong> {{ $ticket->year }}</p>
    <p><strong>Division:</strong> {{ $ticket->divisions->name}}</p>
    <p><strong>Model:</strong> {{ $ticket->models->name}}</p>
    <hr class="mb-2 mt-2">
    <p><strong>Info Type:</strong> {{ $ticket->info_type_label }}</p>
    <p><strong>Information:</strong> {{ $ticket->info_number }}</p>
    <p><strong>Description:</strong> {{ $ticket->details }}</p>
    @foreach ($ticket->attachments as $file)
        <a href="{{ asset('storage/' . $file) }}">Download attachment</a>
    @endforeach

    <p>We will get back to you shortly. Please do not submit multiple tickets for the same issue.</p>
</body>
</html>