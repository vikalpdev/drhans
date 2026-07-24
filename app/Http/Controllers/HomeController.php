<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Specialist;
use App\Models\TestimonialVideo;
use App\Models\Treatment;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'page' => \App\Models\Page::where('slug', 'home')->first(),
            'centres' => Centre::where('is_active', true)->orderBy('order')->get(),
            'treatments' => Treatment::orderBy('order')->get(),
            'specialists' => Specialist::where('is_active', true)->whereHas('type', fn ($q) => $q->where('slug', 'ent-surgeon'))->with('centres')->orderByRaw('TRIM(name)')->get(),
            'founder' => Specialist::where('is_founder', true)->where('is_active', true)->first(),
            'testimonials' => TestimonialVideo::orderBy('order')->get(),
        ]);
    }
}
