<!DOCTYPE html>
<html>
<body style="font-family: sans-serif; color: #163B57;">
    <h2>New Appointment Request</h2>
    <p><strong>Name:</strong> {{ $appointment->name }}</p>
    <p><strong>Phone:</strong> {{ $appointment->phone }}</p>
    <p><strong>Email:</strong> {{ $appointment->email ?? '—' }}</p>
    <p><strong>Centre:</strong> {{ $appointment->centre->name }}</p>
    <p><strong>Department:</strong> {{ $appointment->department }}</p>
    <p><strong>Doctor:</strong> {{ $appointment->specialist->name ?? 'Any available doctor' }}</p>
    <p><strong>Preferred Date:</strong> {{ $appointment->preferred_date?->format('d M Y') ?? '—' }}</p>
    <p><a href="{{ url('/admin/appointments') }}">View in Admin</a></p>
</body>
</html>
