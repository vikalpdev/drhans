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
            'centres' => Centre::orderBy('order')->get(),
            'treatments' => Treatment::orderBy('order')->get(),
            'specialists' => Specialist::where('type', 'ent_surgeon')->orderBy('order')->get(),
            'founder' => Specialist::where('is_founder', true)->first(),
            'testimonials' => TestimonialVideo::orderBy('order')->get(),
        ]);
    }
}
