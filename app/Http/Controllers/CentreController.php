<?php

namespace App\Http\Controllers;

use App\Models\Centre;

class CentreController extends Controller
{
    public function index()
    {
        return view('centres.index', [
            'centres' => Centre::orderBy('order')->get(),
        ]);
    }

    public function show(Centre $centre)
    {
        return view('centres.show', [
            'centre' => $centre->load('galleryItems'),
            'specialists' => $centre->specialists()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function shareExperience()
    {
        return view('centres.share-experience', [
            'centres' => Centre::orderBy('order')->get(),
        ]);
    }
}
