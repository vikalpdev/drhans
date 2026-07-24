<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Specialist;

class AboutController extends Controller
{
    public function index()
    {
        return view('about.index', [
            'page' => \App\Models\Page::where('slug', 'about')->first(),
            'founder' => Specialist::where('is_founder', true)->where('is_active', true)->first(),
            'centres' => Centre::where('is_active', true)->get(),
        ]);
    }

    public function chairman()
    {
        return view('about.chairman', [
            'page' => \App\Models\Page::where('slug', 'chairman')->first(),
            'chairman' => Specialist::where('is_chairman', true)->where('is_active', true)->first(),
            'centres' => Centre::where('is_active', true)->get(),
        ]);
    }
}
