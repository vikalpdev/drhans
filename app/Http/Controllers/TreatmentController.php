<?php

namespace App\Http\Controllers;

use App\Models\Treatment;

class TreatmentController extends Controller
{
    public function index()
    {
        return view('treatments.index', [
            'treatments' => Treatment::orderBy('order')->get(),
        ]);
    }

    public function show(Treatment $treatment)
    {
        return view('treatments.show', [
            'treatment' => $treatment,
            'otherTreatments' => Treatment::where('id', '!=', $treatment->id)->orderBy('order')->take(6)->get(),
        ]);
    }
}
