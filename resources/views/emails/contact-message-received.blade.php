<!DOCTYPE html>
<html>
<body style="font-family: sans-serif; color: #163B57;">
    <h2>New Contact Message</h2>
    <p><strong>Name:</strong> {{ $submission->name }}</p>
    <p><strong>Phone:</strong> {{ $submission->phone }}</p>
    <p><strong>Email:</strong> {{ $submission->email }}</p>
    <p><strong>Centre:</strong> {{ $submission->centre->name ?? '—' }}</p>
    <p><strong>Subject:</strong> {{ $submission->subject ?? '—' }}</p>
    <p><strong>Message:</strong><br>{{ $submission->message }}</p>
    <p><a href="{{ url('/admin/contact-submissions') }}">View in Admin</a></p>
</body>
</html>
