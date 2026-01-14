<!DOCTYPE html>
<html>
<body>
    <h2>Ticket Created</h2>

    <p>
        Your ticket <strong>{{ $ticket->display_number }}</strong> has been created.
    </p>

    <p><strong>Status:</strong> {{ $ticket->status }}</p>

    <p>We will get back to you shortly.</p>
</body>
</html>