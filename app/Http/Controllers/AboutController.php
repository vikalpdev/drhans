<?php

namespace App\Http\Controllers;

use App\Models\Specialist;

class AboutController extends Controller
{
    public function index()
    {
        return view('about.index', [
            'founder' => Specialist::where('is_founder', true)->first(),
        ]);
    }

    public function chairman()
    {
        return view('about.chairman', [
            'chairman' => Specialist::where('is_chairman', true)->first(),
        ]);
    }
}
