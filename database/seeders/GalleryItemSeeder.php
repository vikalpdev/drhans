<?php

namespace Database\Seeders;

use App\Models\Centre;
use App\Models\GalleryCategory;
use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GalleryItemSeeder extends Seeder
{
    public function run(): void
    {
        $centres = Centre::all();
        $categoryIds = GalleryCategory::where('type', 'photo')->pluck('id', 'slug');

        $items = [
            ['title' => 'Delhi (Greater Kailash)', 'category' => 'centres'],
            ['title' => 'Gurgaon', 'category' => 'centres'],
            ['title' => 'Noida', 'category' => 'centres'],
            ['title' => 'Faridabad', 'category' => 'centres'],
            ['title' => 'Consultation Rooms', 'category' => 'facilities'],
            ['title' => 'Advanced Diagnostics', 'category' => 'facilities'],
            ['title' => 'NABH Accredited', 'category' => 'facilities'],
            ['title' => 'Modern Operation Theatres', 'category' => 'facilities'],
            ['title' => 'Cochlear Implant Surgery', 'category' => 'treatments'],
            ['title' => 'Endoscopic ENT Surgery', 'category' => 'treatments'],
            ['title' => 'Hearing Care & Audiology', 'category' => 'treatments'],
            ['title' => 'Vertigo & Balance Care', 'category' => 'treatments'],
            ['title' => 'World Hearing Day 2026', 'category' => 'events'],
            ['title' => 'ENT CME Workshop', 'category' => 'events'],
            ['title' => 'Awareness Campaign', 'category' => 'events'],
            ['title' => 'Live Surgery Demonstration', 'category' => 'events'],
        ];

        foreach ($items as $index => $item) {
            GalleryItem::create([
                'title' => $item['title'],
                'category_id' => $categoryIds[$item['category']] ?? null,
                'centre_id' => $item['category'] === 'centres' ? $centres[$index % $centres->count()]->id : null,
                'order' => $index,
            ]);
        }
    }
}
