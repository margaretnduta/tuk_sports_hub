<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'title')) {
                $table->string('title')->after('id');
            }
            if (!Schema::hasColumn('events', 'sport_type')) {
                $table->string('sport_type')->after('title')->index();
            }
            if (!Schema::hasColumn('events', 'starts_at')) {
                $table->dateTime('starts_at')->after('sport_type');
            }
            if (!Schema::hasColumn('events', 'ends_at')) {
                $table->dateTime('ends_at')->nullable()->after('starts_at');
            }
            if (!Schema::hasColumn('events', 'location')) {
                $table->string('location')->after('ends_at');
            }
            if (!Schema::hasColumn('events', 'description')) {
                $table->text('description')->nullable()->after('location');
            }
            if (!Schema::hasColumn('events', 'cover_image')) {
                $table->string('cover_image')->nullable()->after('description');
            }
            // Ensure coach_id exists (skip if you already have it)
            if (!Schema::hasColumn('events', 'coach_id')) {
                $table->foreignId('coach_id')->nullable()->after('id')->constrained('coaches')->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'cover_image')) $table->dropColumn('cover_image');
            if (Schema::hasColumn('events', 'description')) $table->dropColumn('description');
            if (Schema::hasColumn('events', 'location')) $table->dropColumn('location');
            if (Schema::hasColumn('events', 'ends_at')) $table->dropColumn('ends_at');
            if (Schema::hasColumn('events', 'starts_at')) $table->dropColumn('starts_at');
            if (Schema::hasColumn('events', 'sport_type')) $table->dropColumn('sport_type');
            if (Schema::hasColumn('events', 'title')) $table->dropColumn('title');
            // Only drop if you added it above
            if (Schema::hasColumn('events', 'coach_id')) $table->dropConstrainedForeignId('coach_id');
        });
    }
};
