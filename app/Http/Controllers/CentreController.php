<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use Illuminate\Http\Response;

class CentreController extends Controller
{
    public function index()
    {
        return view('centres.index', [
            'centres' => Centre::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function show(Centre $centre)
    {
        abort_if(! $centre->is_active, Response::HTTP_NOT_FOUND);

        return view('centres.show', [
            'centre' => $centre->load(['galleryItems' => fn ($q) => $q->where('is_active', true)]),
            'specialists' => $centre->specialists()->where('is_active', true)->orderByRaw('TRIM(name)')->get(),
        ]);
    }

    public function shareExperience()
    {
        return view('centres.share-experience', [
            'centres' => Centre::where('is_active', true)->orderBy('order')->get(),
        ]);
    }
}
