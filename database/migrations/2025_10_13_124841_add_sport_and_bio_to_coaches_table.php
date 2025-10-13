<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('coaches', function (Blueprint $table) {
            // add only if missing
            if (!Schema::hasColumn('coaches', 'sport')) {
                $table->string('sport')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('coaches', 'bio')) {
                $table->text('bio')->nullable()->after('sport');
            }
        });
    }

    public function down(): void
    {
        Schema::table('coaches', function (Blueprint $table) {
            if (Schema::hasColumn('coaches', 'bio')) {
                $table->dropColumn('bio');
            }
            if (Schema::hasColumn('coaches', 'sport')) {
                $table->dropColumn('sport');
            }
        });
    }
};
