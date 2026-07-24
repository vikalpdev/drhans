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
            'items' => GalleryItem::where('is_active', true)->with('category')->orderBy('order')->get()->groupBy(fn (GalleryItem $item) => $item->category?->slug),
            'categories' => GalleryCategory::where('type', 'photo')->where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function videos()
    {
        return view('gallery.videos', [
            'videos' => TestimonialVideo::where('is_active', true)->with('category')->orderBy('order')->get(),
            'categories' => GalleryCategory::where('type', 'video')->where('is_active', true)->orderBy('order')->get(),
        ]);
    }
}
