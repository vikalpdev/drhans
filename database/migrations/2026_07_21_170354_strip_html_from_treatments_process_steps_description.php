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
        Treatment::query()->whereNotNull('process_steps')->get()->each(function (Treatment $treatment) {
            $steps = collect($treatment->process_steps)->map(function ($step) {
                $text = $step['description'] ?? '';
                $text = preg_replace('/<\/p>\s*<p[^>]*>/i', "\n\n", $text);
                $text = trim(html_entity_decode(strip_tags($text)));
                $step['description'] = $text;

                return $step;
            })->all();

            $treatment->update(['process_steps' => $steps]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not reversible: HTML formatting is not recoverable from plain text.
    }
};
