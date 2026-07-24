<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Specialist;

class SpecialistController extends Controller
{
    public function index()
    {
        return view('specialists.index', [
            'centres' => Centre::orderBy('order')->get(),
            'surgeons' => Specialist::whereHas('type', fn ($q) => $q->where('slug', 'ent-surgeon'))->orderBy('order')->get(),
            'allied' => Specialist::whereDoesntHave('type', fn ($q) => $q->where('slug', 'ent-surgeon'))->orderBy('order')->get(),
        ]);
    }

    public function audiologists()
    {
        return view('specialists.audiologists', [
            'centres' => Centre::orderBy('order')->get(),
            'audiologists' => Specialist::whereHas('type', fn ($q) => $q->where('slug', 'audiologist'))->orderBy('order')->get(),
        ]);
    }

    public function show(Specialist $specialist)
    {
        return view('specialists.show', [
            'specialist' => $specialist->load('centres'),
        ]);
    }
}
