<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('galleries')) {
            Schema::create('galleries', function (Blueprint $table) {
                $table->id();
                $table->foreignId('fan_id')->constrained()->onDelete('cascade');
                $table->string('image_path');
                $table->string('sport_type')->nullable();
                $table->string('caption')->nullable();
                $table->timestamps();
            });
        } else {
            Schema::table('galleries', function (Blueprint $table) {
                if (!Schema::hasColumn('galleries', 'fan_id')) {
                    $table->foreignId('fan_id')->constrained()->onDelete('cascade');
                }
                if (!Schema::hasColumn('galleries', 'image_path')) {
                    $table->string('image_path');
                }
                if (!Schema::hasColumn('galleries', 'sport_type')) {
                    $table->string('sport_type')->nullable();
                }
                if (!Schema::hasColumn('galleries', 'caption')) {
                    $table->string('caption')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
