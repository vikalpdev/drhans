<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\TestimonialVideo;

class GalleryController extends Controller
{
    public function index()
    {
        return view('gallery.index', [
            'items' => GalleryItem::orderBy('order')->get()->groupBy('category'),
        ]);
    }

    public function videos()
    {
        return view('gallery.videos', [
            'videos' => TestimonialVideo::orderBy('order')->get(),
        ]);
    }
}
