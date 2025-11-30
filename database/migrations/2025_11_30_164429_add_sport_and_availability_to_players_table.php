<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('players', function (Blueprint $table) {
            // Add sport if missing
            if (!Schema::hasColumn('players', 'sport')) {
                $table->string('sport')->nullable()->after('user_id');
            }

            // Add availability_status if missing
            if (!Schema::hasColumn('players', 'availability_status')) {
                $table->string('availability_status')
                    ->default('available')
                    ->after('sport');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            if (Schema::hasColumn('players', 'availability_status')) {
                $table->dropColumn('availability_status');
            }

            if (Schema::hasColumn('players', 'sport')) {
                $table->dropColumn('sport');
            }
        });
    }
};
