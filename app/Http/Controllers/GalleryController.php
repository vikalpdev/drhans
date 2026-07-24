<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use App\Models\GalleryItem;
use App\Models\TestimonialVideo;

class GalleryController extends Controller
{
    public function index()
    {
        return view('gallery.index', [
            'items' => GalleryItem::with('category')->orderBy('order')->get()->groupBy(fn (GalleryItem $item) => $item->category?->slug),
            'categories' => GalleryCategory::where('type', 'photo')->orderBy('order')->get(),
        ]);
    }

    public function videos()
    {
        return view('gallery.videos', [
            'videos' => TestimonialVideo::with('category')->orderBy('order')->get(),
            'categories' => GalleryCategory::where('type', 'video')->orderBy('order')->get(),
        ]);
    }
}
