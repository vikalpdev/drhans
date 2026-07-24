<?php

use App\Models\Treatment;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Treatment::query()->whereNotNull('details')->where('details', '!=', '')->get()->each(function (Treatment $treatment) {
            if (str_contains($treatment->details, '<p') || str_contains($treatment->details, '<div')) {
                return;
            }

            $html = collect(preg_split('/\n\s*\n/', trim($treatment->details)))
                ->map(fn ($paragraph) => '<p>'.e(trim($paragraph)).'</p>')
                ->implode('');

            $treatment->update(['details' => $html]);
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
