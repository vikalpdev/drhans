<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactMessageReceivedMail;
use App\Models\Centre;
use App\Models\ContactSubmission;
use App\Models\Page;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index', [
            'page' => Page::where('slug', 'contact')->first(),
            'centres' => Centre::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function store(StoreContactRequest $request)
    {
        $submission = ContactSubmission::create($request->safe()->except('website'));

        Mail::to(config('mail.admin_address'))->send(new ContactMessageReceivedMail($submission));

        return back()->with('success', 'Thank you for reaching out! Our team will get back to you shortly.');
    }
}
