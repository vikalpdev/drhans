<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Specialist;
use Illuminate\Http\Response;

class SpecialistController extends Controller
{
    public function index()
    {
        return view('specialists.index', [
            'centres' => Centre::orderBy('order')->get(),
            'surgeons' => Specialist::where('is_active', true)->whereHas('type', fn ($q) => $q->where('slug', 'ent-surgeon'))->orderBy('name')->get(),
            'allied' => Specialist::where('is_active', true)->whereDoesntHave('type', fn ($q) => $q->where('slug', 'ent-surgeon'))->orderBy('name')->get(),
        ]);
    }

    public function audiologists()
    {
        return view('specialists.audiologists', [
            'centres' => Centre::orderBy('order')->get(),
            'audiologists' => Specialist::where('is_active', true)->whereHas('type', fn ($q) => $q->where('slug', 'audiologist'))->orderBy('name')->get(),
        ]);
    }

    public function show(Specialist $specialist)
    {
        abort_if(! $specialist->is_active, Response::HTTP_NOT_FOUND);

        return view('specialists.show', [
            'specialist' => $specialist->load(['centres', 'approvedReviews']),
        ]);
    }
}
