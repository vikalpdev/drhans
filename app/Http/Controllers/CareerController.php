<?php

namespace App\Http\Controllers;

use App\Models\JobOpening;
use App\Models\Page;

class CareerController extends Controller
{
    public function index()
    {
        return view('careers.index', [
            'page' => Page::where('slug', 'careers')->first(),
            'jobs' => JobOpening::where('is_active', true)->orderBy('title')->get(),
        ]);
    }
}
