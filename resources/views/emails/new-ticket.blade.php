<!DOCTYPE html>
<html>
<body>
    <h2>Ticket Created</h2>

    <p>
        Your ticket <strong>{{ $ticket->display_number }}</strong> has been created.
    </p>

    <p><strong>Status:</strong> {{ $ticket->status }}</p>
    @foreach ($ticket->attachments as $file)
        <a href="{{ asset('storage/' . $file) }}">Download attachment</a>
    @endforeach

    <p>We will get back to you shortly.</p>
</body>
</html>