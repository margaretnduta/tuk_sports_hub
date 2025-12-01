<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('event_fans')) {
            Schema::create('event_fans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('event_id')->constrained()->onDelete('cascade');
                $table->foreignId('fan_id')->constrained()->onDelete('cascade');
                $table->string('status')->default('none'); // none / attending / not_attending
                $table->timestamps();
            });
        } else {
            Schema::table('event_fans', function (Blueprint $table) {
                if (!Schema::hasColumn('event_fans', 'event_id')) {
                    $table->foreignId('event_id')->constrained()->onDelete('cascade');
                }
                if (!Schema::hasColumn('event_fans', 'fan_id')) {
                    $table->foreignId('fan_id')->constrained()->onDelete('cascade');
                }
                if (!Schema::hasColumn('event_fans', 'status')) {
                    $table->string('status')->default('none');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('event_fans');
    }
};
