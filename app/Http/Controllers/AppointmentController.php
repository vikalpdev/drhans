<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Mail\AppointmentReceivedMail;
use App\Models\Appointment;
use App\Models\Centre;
use App\Models\Specialist;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function create()
    {
        $centres = Centre::where('is_active', true)->orderBy('order')->get();
        $specialists = Specialist::where('is_active', true)->orderBy('order')->get();

        return view('appointment.create', [
            'centres' => $centres,
            'specialists' => $specialists,
            'selectedCentre' => $centres->firstWhere('slug', request('centre')),
            'selectedSpecialist' => $specialists->firstWhere('slug', request('specialist')),
            'selectedDate' => request('date'),
            'selectedDepartment' => request('department'),
        ]);
    }

    public function store(StoreAppointmentRequest $request)
    {
        $data = $request->safe()->except('website');

        $isDuplicate = Appointment::where('phone', $data['phone'])
            ->where('created_at', '>=', now()->subHours(6))
            ->exists();

        $appointment = Appointment::create([
            ...$data,
            'status' => $isDuplicate ? 'junk' : 'new',
        ]);

        if (! $isDuplicate) {
            Mail::to(config('mail.admin_address'))->send(new AppointmentReceivedMail($appointment));
        }

        return back()->with('success', "Thank you! Your appointment request has been received. Our team will confirm shortly.");
    }
}
