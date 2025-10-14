<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events','status')) {
                $table->enum('status', ['scheduled','postponed','cancelled','completed'])
                      ->default('scheduled')->after('cover_image');
            }
            if (!Schema::hasColumn('events','postponed_to')) {
                $table->dateTime('postponed_to')->nullable()->after('status');
            }
            if (!Schema::hasColumn('events','postpone_reason')) {
                $table->string('postpone_reason')->nullable()->after('postponed_to');
            }
        });
    }
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events','postpone_reason')) $table->dropColumn('postpone_reason');
            if (Schema::hasColumn('events','postponed_to')) $table->dropColumn('postponed_to');
            if (Schema::hasColumn('events','status')) $table->dropColumn('status');
        });
    }
};
