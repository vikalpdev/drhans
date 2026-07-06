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
            'surgeons' => Specialist::where('type', 'ent_surgeon')->orderBy('order')->get(),
            'allied' => Specialist::where('type', '!=', 'ent_surgeon')->orderBy('order')->get(),
        ]);
    }

    public function show(Specialist $specialist)
    {
        return view('specialists.show', [
            'specialist' => $specialist->load('centres'),
        ]);
    }
}
