<?php

use App\Models\Treatment;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    private function wrap(?string $text): ?string
    {
        if (blank($text)) {
            return $text;
        }

        if (str_contains($text, '<p') || str_contains($text, '<div')) {
            return $text;
        }

        return collect(preg_split('/\n\s*\n/', trim($text)))
            ->map(fn ($paragraph) => '<p>'.e(trim($paragraph)).'</p>')
            ->implode('');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Treatment::query()->get()->each(function (Treatment $treatment) {
            $services = $treatment->services === null ? null : collect($treatment->services)->map(function ($service) {
                $service['description'] = $this->wrap($service['description'] ?? null);

                return $service;
            })->all();

            $steps = $treatment->process_steps === null ? null : collect($treatment->process_steps)->map(function ($step) {
                $step['description'] = $this->wrap($step['description'] ?? null);

                return $step;
            })->all();

            $faqs = $treatment->faqs === null ? null : collect($treatment->faqs)->map(function ($faq) {
                $faq['answer'] = $this->wrap($faq['answer'] ?? null);

                return $faq;
            })->all();

            $treatment->update([
                'services' => $services,
                'process_steps' => $steps,
                'faqs' => $faqs,
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not reversible: original plain-text line breaks are not recoverable from HTML.
    }
};
