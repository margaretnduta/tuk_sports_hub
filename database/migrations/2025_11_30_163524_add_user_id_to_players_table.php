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
            // Only add the column if it is missing to avoid conflicts
            if (!Schema::hasColumn('players', 'user_id')) {
                $table->foreignId('user_id')
                    ->after('id')
                    ->constrained()
                    ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            if (Schema::hasColumn('players', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
