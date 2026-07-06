<?php

namespace App\Http\Controllers;

use App\Models\JobOpening;

class CareerController extends Controller
{
    public function index()
    {
        return view('careers.index', [
            'jobs' => JobOpening::where('is_active', true)->orderBy('title')->get(),
        ]);
    }
}
