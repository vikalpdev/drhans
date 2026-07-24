<?php

use App\Models\Specialist;
use App\Models\SpecialistType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $types = [
        'ent_surgeon' => ['name' => 'Otorhinolaryngologist', 'slug' => 'ent-surgeon'],
        'audiologist' => ['name' => 'Audiologist', 'slug' => 'audiologist'],
        'allied' => ['name' => 'Allied Specialist', 'slug' => 'allied-specialist'],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('specialists', function (Blueprint $table) {
            $table->foreignId('type_id')->nullable()->after('type')->constrained('specialist_types')->nullOnDelete();
        });

        $typeIds = [];
        $order = 0;
        foreach ($this->types as $oldValue => $type) {
            $typeIds[$oldValue] = SpecialistType::create([
                'name' => $type['name'],
                'slug' => $type['slug'],
                'order' => $order++,
            ])->id;
        }

        Specialist::query()->whereNotNull('type')->get()->each(function (Specialist $specialist) use ($typeIds) {
            if (isset($typeIds[$specialist->type])) {
                $specialist->update(['type_id' => $typeIds[$specialist->type]]);
            }
        });

        Schema::table('specialists', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('specialists', function (Blueprint $table) {
            $table->enum('type', ['ent_surgeon', 'audiologist', 'allied'])->default('ent_surgeon')->after('slug');
        });

        Specialist::query()->with('type')->get()->each(function (Specialist $specialist) {
            $map = ['ent-surgeon' => 'ent_surgeon', 'audiologist' => 'audiologist', 'allied-specialist' => 'allied'];
            $specialist->update(['type' => $map[$specialist->type?->slug] ?? 'ent_surgeon']);
        });

        Schema::table('specialists', function (Blueprint $table) {
            $table->dropConstrainedForeignId('type_id');
        });

        SpecialistType::query()->delete();
    }
};
