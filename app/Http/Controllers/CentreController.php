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
}
