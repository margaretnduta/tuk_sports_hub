<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('coaches', function (Blueprint $table) {
            // Add only if missing
            if (!Schema::hasColumn('coaches', 'user_id')) {
                $table->foreignId('user_id')
                      ->after('id')
                      ->constrained()
                      ->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('coaches', function (Blueprint $table) {
            if (Schema::hasColumn('coaches', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
        });
    }
};
